<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { store } from '@/routes/login';

import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';
import TextLink from '@/components/ui/text-link/TextLink.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
</script>

<template>
    <Head title="Sign in" />

    <AuthLayout title="Sign in to your account">
        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            class="space-y-4 md:space-y-6"
            #default="{ errors, processing }"
        >
            <div>
                <Label for="email" :error="!!errors.email">Your email</Label>
                <Input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="name@company.com"
                    :error="!!errors.email"
                    required
                />
                <InputError :message="errors.email" />
            </div>

            <div>
                <Label for="password" :error="!!errors.password">Password</Label>
                <Input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    :error="!!errors.password"
                    required
                />
                <InputError :message="errors.password" />
            </div>

            <Button type="submit" full-width :disabled="processing">
                {{ processing ? 'Signing in...' : 'Sign in' }}
            </Button>
        </Form>
    </AuthLayout>
</template>