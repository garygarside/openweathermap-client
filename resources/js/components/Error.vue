<template>
    <div class="my-4 lg:my-12 mx-auto max-w-2xl rounded-lg border border-red-700 p-4 text-red-500">
        <div class="flex items-center gap-3 font-semibold">
            <ExclamationTriangleIcon class="size-6 stroke-2" />
            <p>{{ error }}</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';

defineProps<{
    error: string;
}>();
</script>