<script lang="ts" setup>
export interface InputErrorProps {
    message?: string;
}

defineProps<InputErrorProps>();
</script>

<template>
    <p v-if="message" class="mt-2 text-sm text-red-600 dark:text-red-500">
        <span class="font-medium">Oh, snapp!</span> {{ message }}
    </p>
</template>
