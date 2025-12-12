<template>
    <Head title="OpenWeatherMap Client" />

    <div class="flex min-h-screen flex-col justify-center items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <div class="fixed bottom-10 text-white flex items-center gap-1">
            <img src="/icons/animated/weather.svg" alt="Logo" class="h-8 w-auto" />
            <h1 class="font-semibold">OpenWeatherMap</h1>
        </div>

        <Error v-if="$page.props.missingKey" error="Please populate your OPENWEATHER_API_KEY variable in your .env file" />

        <Search v-else />
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Search from '@/components/Search.vue';
import Error from '@/components/Error.vue';
</script>