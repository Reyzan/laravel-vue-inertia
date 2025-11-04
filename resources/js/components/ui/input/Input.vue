<script lang="ts" setup>
import { useVModel } from '@vueuse/core';
import { computed } from 'vue';

export interface InputProps {
    defaultValue?: string | number;
    modelValue?: string | number;
    error?: boolean;
    variant?: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info';
    size?: 'xs' | 'sm' | 'md' | 'lg' | 'xl';
    disabled?: boolean;
}

const props = withDefaults(defineProps<InputProps>(), {
    error: false,
    variant: 'primary',
    size: 'md',
    disabled: false,
});

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void
}>()

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
});

const inputClasses = computed(() => {
    const baseClasses = 'rounded-lg block w-full border transition-colors';

    // Size classes
    const sizeClasses = {
        xs: 'px-2 py-1.5 text-xs',
        sm: 'px-2.5 py-2 text-sm',
        md: 'px-2.5 py-2.5 text-sm',
        lg: 'px-3 py-3 text-base',
        xl: 'px-3.5 py-3.5 text-base',
    };

    // Error state takes precedence
    if (props.error) {
        return `${baseClasses} ${sizeClasses[props.size]} bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500`;
    }

    // Variant classes
    const variantClasses = {
        primary: 'bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',
        secondary: 'bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500',
        success: 'bg-green-50 border-green-300 text-green-900 placeholder-green-600 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-green-600 dark:placeholder-green-400 dark:text-green-400 dark:focus:ring-green-500 dark:focus:border-green-500',
        danger: 'bg-red-50 border-red-300 text-red-900 placeholder-red-600 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-red-600 dark:placeholder-red-400 dark:text-red-400 dark:focus:ring-red-500 dark:focus:border-red-500',
        warning: 'bg-yellow-50 border-yellow-300 text-yellow-900 placeholder-yellow-600 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-yellow-600 dark:placeholder-yellow-400 dark:text-yellow-400 dark:focus:ring-yellow-500 dark:focus:border-yellow-500',
        info: 'bg-blue-50 border-blue-300 text-blue-900 placeholder-blue-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-blue-400 dark:focus:ring-blue-500 dark:focus:border-blue-500',
    };

    const disabledClass = props.disabled ? 'opacity-50 cursor-not-allowed' : '';

    return `${baseClasses} ${sizeClasses[props.size]} ${variantClasses[props.variant]} ${disabledClass}`;
});
</script>

<template>
    <input
        v-model="modelValue"
        :class="inputClasses"
        :disabled="disabled"
    />
</template>
