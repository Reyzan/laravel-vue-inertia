<script lang="ts" setup>
export interface LabelProps {
    for?: string;
    error?: boolean;
}

const props = withDefaults(defineProps<LabelProps>(), {
    error: false,
});
</script>

<template>
    <label :for="props.for" :class="[
        'block mb-2 text-sm font-medium',
        props.error
            ? 'text-red-700 dark:text-red-500'
            : 'text-gray-900 dark:text-white'
    ]">
        <slot />
    </label>
</template>
