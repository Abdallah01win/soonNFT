<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />
        <div class="">
            <div class="mb-6">
                <Link :href="route('/')" class="block cursor-pointer font-inter text-4xl font-extrabold uppercase mb-4">Soonnft</Link>
                <div class="text-lg font-semibold">Welcome Back!</div>
                <p class="text-white/50">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            </div>
            <form @submit.prevent="submit" class="">
                <div>
                    <!-- <InputLabel for="email" value="Email" /> -->

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" placeholder="Email" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-5">
                    <!-- <InputLabel for="password" value="Password" /> -->

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" placeholder="Password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-5">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-white/50">Remember me</span>
                    </label>
                </div>

                <PrimaryButton class="w-full justify-center mt-5" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Log in
                </PrimaryButton>

                <div class="flex items-center justify-between mt-4">
                    <Link v-if="canResetPassword" :href="route('register')"
                        class="underline text-sm text-white/50 hover:hover:text-white rounded-md focus:outline-none underline-offset-4">
                    Don't have an account?
                    </Link>

                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="underline text-sm text-white/50 hover:hover:text-white rounded-md focus:outline-none underline-offset-4">
                    Forgot your password?
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
