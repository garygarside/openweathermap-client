<template>
    <div class="my-4 lg:my-12 mx-auto max-w-2xl text-white flex flex-col-reverse lg:flex-row items-center justify-between">
        <div class="px-6 flex flex-col gap-1">
            <h3 class="text-center lg:text-left text-3xl lg:text-5xl font-semibold">{{ currentLocation.name }}</h3>
            <p class="text-center lg:text-left text-base lg:text-lg text-gray-200">{{ ucwords(currentLocation.data.description) }}</p>
            <p class="mt-4 lg:mt-0 flex flex-wrap justify-center lg:justify-start items-center gap-2 text-sm lg:text-base text-gray-500 relative -left-2">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 30 30" class="size-5 lg:size-6">
                        <path fill="currentColor" d="M9.91 19.56a5.101 5.101 0 0 1 2.24-4.22V5.42c0-.8.27-1.48.82-2.03s1.23-.84 2.03-.84c.81 0 1.49.28 2.04.83c.55.56.83 1.23.83 2.03v9.92c.71.49 1.25 1.11 1.64 1.84s.58 1.53.58 2.38c0 .92-.23 1.78-.68 2.56s-1.07 1.4-1.85 1.85s-1.63.68-2.56.68c-.92 0-1.77-.23-2.55-.68s-1.4-1.07-1.86-1.85s-.68-1.63-.68-2.55zm1.76 0c0 .93.33 1.73.98 2.39c.65.66 1.44.99 2.36.99c.93 0 1.73-.33 2.4-1s1.01-1.46 1.01-2.37c0-.62-.16-1.2-.48-1.73c-.32-.53-.76-.94-1.32-1.23l-.28-.14c-.1-.04-.15-.14-.15-.29V5.42c0-.32-.11-.59-.34-.81c-.23-.21-.51-.32-.85-.32c-.32 0-.6.11-.83.32c-.23.21-.34.48-.34.81v10.74c0 .15-.05.25-.14.29l-.27.14c-.55.29-.98.7-1.29 1.23c-.31.53-.46 1.1-.46 1.74zm.78 0c0 .71.24 1.32.73 1.82s1.07.75 1.76.75s1.28-.25 1.79-.75s.76-1.11.76-1.81c0-.63-.22-1.19-.65-1.67c-.43-.48-.96-.77-1.58-.85V9.69c0-.06-.03-.13-.1-.19a.299.299 0 0 0-.22-.1c-.09 0-.16.03-.21.08c-.05.06-.08.12-.08.21v7.34c-.61.09-1.13.37-1.56.85c-.43.49-.64 1.04-.64 1.68z"/>
                    </svg>

                    {{ Math.round(currentLocation.data.temperature) }}°C,
                </span>
                
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 30 30" class="size-5 lg:size-6">
                        <path fill="currentColor" d="M7.56 17.19c0-.88.24-1.89.72-3.03s1.1-2.25 1.86-3.31c1.56-2.06 2.92-3.62 4.06-4.67l.75-.72c.25.26.53.5.83.72c.41.42 1.04 1.11 1.88 2.09s1.57 1.85 2.17 2.65c.71 1.01 1.32 2.1 1.81 3.25s.74 2.16.74 3.03c0 1-.19 1.95-.58 2.86c-.39.91-.91 1.7-1.57 2.36c-.66.66-1.45 1.19-2.37 1.58c-.92.39-1.89.59-2.91.59c-1 0-1.95-.19-2.86-.57c-.91-.38-1.7-.89-2.36-1.55c-.66-.65-1.19-1.44-1.58-2.35s-.59-1.89-.59-2.93zm2.26-2.93c0 .83.17 1.49.52 1.99c.35.49.88.74 1.59.74c.72 0 1.25-.25 1.61-.74c.35-.49.53-1.15.54-1.99c-.01-.84-.19-1.5-.54-2c-.35-.49-.89-.74-1.61-.74c-.71 0-1.24.25-1.59.74c-.35.5-.52 1.16-.52 2zm1.57 0v-.35c0-.08.01-.19.02-.33s.02-.25.05-.32s.05-.16.09-.24c.04-.08.09-.15.15-.18c.07-.04.14-.06.23-.06c.14 0 .25.04.33.12s.14.21.17.38c.03.18.05.32.06.45s.01.3.01.52c0 .23 0 .4-.01.52s-.03.27-.06.45c-.03.17-.09.3-.17.38s-.19.12-.33.12c-.09 0-.16-.02-.23-.06a.335.335 0 0 1-.15-.18c-.04-.08-.07-.17-.09-.24c-.02-.08-.04-.19-.05-.32c-.01-.14-.02-.25-.02-.32v-.34zm.59 7.75h1.32l4.99-10.74h-1.35l-4.96 10.74zm4.3-2.99c.01.84.2 1.5.55 2c.35.49.89.74 1.6.74c.72 0 1.25-.25 1.6-.74c.35-.49.52-1.16.53-2c-.01-.84-.18-1.5-.53-1.99c-.35-.49-.88-.74-1.6-.74c-.71 0-1.25.25-1.6.74c-.36.49-.54 1.15-.55 1.99zm1.57 0c0-.23 0-.4.01-.52s.03-.27.06-.45s.09-.3.17-.38s.19-.12.33-.12c.09 0 .17.02.24.06c.07.04.12.1.16.19c.04.09.07.17.1.24s.04.18.05.32l.01.32v.69l-.01.32l-.05.32l-.1.24l-.16.19l-.24.06c-.14 0-.25-.04-.33-.12s-.14-.21-.17-.38c-.03-.18-.05-.33-.06-.45s-.01-.3-.01-.53z"/>
                    </svg>

                    {{ currentLocation.data.humidity }}% humidity
                </span>

                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 30 30" class="size-5 lg:size-6 mr-1">
                        <path fill="currentColor" d="M3.1 16.97c0 .24.09.45.28.62c.16.19.37.28.63.28H18.7c.29 0 .53.1.73.3c.2.2.3.45.3.74s-.1.53-.3.72c-.2.19-.44.29-.74.29c-.29 0-.54-.1-.73-.29a.76.76 0 0 0-.6-.26c-.25 0-.46.09-.64.26s-.27.38-.27.61c0 .25.09.46.28.63c.56.55 1.22.83 1.96.83c.78 0 1.45-.27 2.01-.81c.56-.54.83-1.19.83-1.97s-.28-1.44-.84-2c-.56-.56-1.23-.84-2-.84H4.01a.9.9 0 0 0-.64.26c-.18.17-.27.38-.27.63zm0-3.28c0 .23.09.43.28.61c.17.18.38.26.63.26h20.04c.78 0 1.45-.27 2.01-.82c.56-.54.84-1.2.84-1.97s-.28-1.44-.84-1.99s-1.23-.83-2.01-.83c-.77 0-1.42.27-1.95.8c-.18.16-.27.38-.27.67c0 .26.09.47.26.63c.17.16.38.24.63.24c.24 0 .45-.08.63-.24c.19-.21.42-.31.7-.31c.29 0 .53.1.73.3c.2.2.3.44.3.73s-.1.53-.3.72c-.2.19-.44.29-.73.29H4.01a.908.908 0 0 0-.91.91z"/>
                    </svg>

                    {{ currentLocation.data.wind_speed }}m/s winds

                    <span
                        class="ml-1 inline-block transform"
                        :style="{ rotate: currentLocation.data.wind_direction + 'deg' }"
                    >
                        <ArrowUpCircleIcon class="size-5 lg:size-6" />
                    </span>
                </span>
            </p>
        </div>

        <WeatherIcon :description="currentLocation.data.description" />
    </div>
</template>

<script setup lang="ts">
import { ArrowUpCircleIcon } from '@heroicons/vue/24/outline';
import WeatherIcon from './WeatherIcon.vue';

defineProps<{
    currentLocation: {
        name: string;
        data: {
            description: string;
            temperature: number;
            humidity: number;
            wind_speed: number;
            wind_direction: number;
        };
    };
}>();

const ucwords = (str: string) => {
    return str.replace(/\b\w/g, (char) => char.toUpperCase());
};
</script>