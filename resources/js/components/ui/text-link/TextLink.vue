<script lang="ts" setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

export interface TextLinkProps {
    href?: string;
    variant?: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info' | 'light' | 'dark';
    size?: 'xs' | 'sm' | 'md' | 'lg' | 'xl';
    underline?: boolean;
    disabled?: boolean;
    external?: boolean;
}

const props = withDefaults(defineProps<TextLinkProps>(), {
    href: '#',
    variant: 'primary',
    size: 'sm',
    underline: true,
    disabled: false,
    external: false,
});

const linkClasses = computed(() => {
    const baseClasses = 'font-medium transition-colors';

    // Size classes
    const sizeClasses = {
        xs: 'text-xs',
        sm: 'text-sm',
        md: 'text-base',
        lg: 'text-lg',
        xl: 'text-xl',
    };

    // Variant classes with hover states
    const variantClasses = {
        primary: 'text-primary-600 hover:text-primary-700 dark:text-primary-500 dark:hover:text-primary-400',
        secondary: 'text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300',
        success: 'text-green-600 hover:text-green-700 dark:text-green-500 dark:hover:text-green-400',
        danger: 'text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-400',
        warning: 'text-yellow-600 hover:text-yellow-700 dark:text-yellow-500 dark:hover:text-yellow-400',
        info: 'text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400',
        light: 'text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400',
        dark: 'text-gray-900 hover:text-gray-800 dark:text-gray-100 dark:hover:text-gray-200',
    };

    const underlineClass = props.underline ? 'hover:underline' : '';
    const disabledClass = props.disabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : 'cursor-pointer';

    return `${baseClasses} ${sizeClasses[props.size]} ${variantClasses[props.variant]} ${underlineClass} ${disabledClass}`;
});

const linkAttrs = computed(() => {
    const attrs: Record<string, any> = {};

    if (props.external) {
        attrs.target = '_blank';
        attrs.rel = 'noopener noreferrer';
    }

    return attrs;
});
</script>

<template>
    <!-- Use regular anchor tag for external links -->
    <a
        v-if="external"
        :href="href"
        v-bind="linkAttrs"
        :class="linkClasses"
    >
        <slot />
    </a>

    <!-- Use Inertia Link for internal navigation -->
    <Link
        v-else
        :href="href"
        :class="linkClasses"
    >
        <slot />
    </Link>
</template>
