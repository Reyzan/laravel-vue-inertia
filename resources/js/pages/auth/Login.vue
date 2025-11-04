<script setup lang="ts">
import { ref } from 'vue';

import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';
import TextLink from '@/components/ui/text-link/TextLink.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';

const email = ref('');
const password = ref('');
</script>

<template>
    <AuthLayout title="Sign in to your account">
        <form class="space-y-4 md:space-y-6" action="#">
            <Input v-model="email" label="Your email" type="email" id="email" placeholder="name@company.com"
                :required="true" />
            <Input v-model="password" label="Password" type="password" id="password" placeholder="••••••••"
                :required="true" />
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                            required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                    </div>
                </div>
                <TextLink href="#">Forgot password?</TextLink>
            </div>
            <Button type="submit" full-width>Sign in</Button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Don't have an account yet? <TextLink href="#">Sign up</TextLink>
            </p>
        </form>
    </AuthLayout>
</template>