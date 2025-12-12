<template>
    <div>
        <img
            v-if="description.toLowerCase().includes('rain') && description.toLowerCase().includes('light')"
            src="/icons/animated/rainy-4.svg"
            class="size-32 lg:size-40"
        />

        <img
            v-if="description.toLowerCase().includes('rain') && description.toLowerCase().includes('heavy')"
            src="/icons/animated/rainy-7.svg"
            class="size-32 lg:size-40"
        />

        <img
            v-else-if="description.toLowerCase().includes('sun') && (description.toLowerCase().includes('spell') || description.toLowerCase().includes('cloud'))"
            src="/icons/animated/cloudy-day-2.svg"
            class="size-32 lg:size-40"
        />

        <img
            v-else-if="description.toLowerCase().includes('sun')"
            src="/icons/animated/day.svg"
            class="size-32 lg:size-40"
        />

        <img
            v-else-if="description.toLowerCase().includes('cloud')"
            src="/icons/animated/cloudy.svg"
            class="size-32 lg:size-40"
        />
    </div>
</template>

<script setup lang="ts">
defineProps<{
    description: string;
}>();
</script>