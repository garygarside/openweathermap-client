<template>
    <Dialog class="relative z-10" open>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
            <DialogPanel class="mx-auto max-w-2xl transform divide-y divide-gray-500/10 overflow-hidden rounded-xl bg-white/80 shadow-2xl outline-1 outline-black/5 backdrop-blur-sm backdrop-filter transition-all dark:divide-white/10 dark:bg-gray-900/80 dark:-outline-offset-1 dark:outline-white/10">
                <Combobox @update:modelValue="onSelect">
                    <div class="grid grid-cols-1">
                        <ComboboxInput
                            class="col-start-1 row-start-1 h-12 w-full bg-transparent pr-4 pl-11 text-base text-gray-900 outline-hidden placeholder:text-gray-500 sm:text-sm dark:text-white dark:placeholder:text-gray-400"
                            placeholder="Search..."
                            @change="query = $event.target.value;"
                        />
                        <MagnifyingGlassIcon
                            class="pointer-events-none col-start-1 row-start-1 ml-4 size-5 self-center text-gray-900/40 dark:text-gray-500"
                            aria-hidden="true"
                        />
                    </div>

                    <ComboboxOptions
                        v-if="(query === '' && recentLocations.length > 0) || filteredLocations.length > 0"
                        static
                        as="ul"
                        class="max-h-80 scroll-py-2 divide-y divide-gray-500/10 overflow-y-auto dark:divide-white/5"
                    >
                        <li class="p-2">
                            <h2
                                v-if="query === '' && recentLocations.length > 0"
                                class="mt-4 mb-2 px-3 text-xs font-semibold text-gray-900 dark:text-white"
                            >Recent searches</h2>

                            <ul class="text-sm text-gray-700 dark:text-gray-300">
                                <ComboboxOption
                                    v-for="location in query === '' ? recentLocations : filteredLocations"
                                    :key="location"
                                    :value="location"
                                    as="template"
                                    v-slot="{ active }"
                                >
                                    <li :class="['flex cursor-default items-center rounded-md px-3 py-2 select-none', active && 'bg-gray-900/5 text-gray-900 outline-hidden dark:bg-white/5 dark:text-white']">
                                        <MapPinIcon
                                            :class="['size-6 flex-none', !active && 'text-gray-900/40 dark:text-gray-500', active && 'text-gray-900 dark:text-white']"
                                            aria-hidden="true"
                                        />
                                        <span class="ml-3 flex-auto truncate">{{ location }}</span>
                                        <span
                                            v-if="active"
                                            class="ml-3 flex-none text-gray-500 dark:text-gray-400"
                                        >Fetch Weather</span>
                                    </li>
                                </ComboboxOption>
                            </ul>
                        </li>
                    </ComboboxOptions>

                    <ComboboxOptions
                        v-else-if="query !== ''"
                        static
                        as="ul"
                        class="max-h-80 scroll-py-2 divide-y divide-gray-500/10 overflow-y-auto dark:divide-white/5"
                    >
                        <li class="p-2">
                            <ul class="text-sm text-gray-700 dark:text-gray-300">
                                <ComboboxOption
                                    as="template"
                                    v-slot="{ active }"
                                >
                                    <li :class="['flex cursor-default items-center rounded-md px-3 py-2 select-none', active && 'bg-gray-900/5 text-gray-900 outline-hidden dark:bg-white/5 dark:text-white']">
                                        <MapPinIcon
                                            :class="['size-6 flex-none', !active && 'text-gray-900/40 dark:text-gray-500', active && 'text-gray-900 dark:text-white']"
                                            aria-hidden="true"
                                        />
                                        <span class="ml-3 flex-auto truncate">{{ query }}</span>
                                        <span
                                            v-if="active"
                                            class="ml-3 flex-none text-gray-500 dark:text-gray-400"
                                        >Search Weather</span>
                                    </li>
                                </ComboboxOption>
                            </ul>
                        </li>
                    </ComboboxOptions>
                </Combobox>
            </DialogPanel>

            <Error v-if="error" :error="error" />

            <div
                v-if="!filteredLocations.length && (!query || query.trim() === '') && !currentLocation"
                class="my-12 lg:mt-24 lg:grow mx-auto max-w-2xl text-2xl lg:text-4xl text-center text-gray-700 font-medium tracking-tight leading-7 lg:leading-10"
            >
                <p class="max-w-[25ch] mx-auto">Search for a location to view your weather report.</p>
            </div>

            <LocationSummary
                v-if="currentLocation"
                :currentLocation="currentLocation"
            />
        </div>
    </Dialog>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
import { MapPinIcon } from '@heroicons/vue/24/outline';
import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
    Dialog,
    DialogPanel,
} from '@headlessui/vue';
import Error from './Error.vue';
import LocationSummary from './LocationSummary.vue';

const presetLocations: string[] = [
    'London',
    'Birmingham',
    'Leeds',
    'Manchester',
    'Glasgow',
    'Sheffield',
    'Bradford',
    'Liverpool',
    'Edinburgh',
    'Bristol',
].sort();

const recentLocations: string[] = [];
const recentLocationsLimit: number = 3;
const query = ref<string>('');
const error = ref<string | null>(null);
const currentLocation = ref<{
    name: string;
    country: string;
    data: {
        temperature: number;
        description: string;
        humidity: number;
        wind_speed: number;
        wind_direction: number;
    }
} | null>(null);

const filteredLocations = computed(() =>
    query.value === ''
        ? []
        : presetLocations.filter((location) => {
            return location.toLowerCase().includes(query.value.toLowerCase())
        }),
);

async function onSelect (item: string) {
    if (item) {
        fetchWeather(item);
    } else {
        fetchWeather(query.value);
    }

    query.value = '';
}

async function fetchWeather (location: string) {
    error.value = null;

    await fetch(`/api/weather/fetch`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ location: location }),
        })
            .then(res => res.json())
            .then((res) => {
                if (res.message) {
                    error.value = res.message;
                    currentLocation.value = null;
                    return;
                }

                if (!recentLocations.includes(location)) {
                    recentLocations.unshift(location);
                    
                    if (recentLocations.length > recentLocationsLimit) {
                        recentLocations.pop();
                    }
                }

                query.value = '';
                currentLocation.value = res;
            }).catch(() => {
                error.value = 'An error occurred while fetching the weather data.';
                currentLocation.value = null;
            });
}
</script>