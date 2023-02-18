<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: true,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <div class="mb-6">
            <Link :href="route('/')" class="w-fit">
                <img src="/storage/assets/Logo.svg" class="w-[215px]"/>
                </Link>
            <div class="text-lg font-semibold mt-4">Welcome!</div>
            <p class="text-white/50">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
        </div>

        <form @submit.prevent="submit">
            <div>
                <!-- <InputLabel for="name" value="Name" /> -->

                <TextInput id="name" type="text" class="mt-5 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" placeholder="Name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <!-- <InputLabel for="email" value="Email" /> -->

                <TextInput id="email" type="email" class="mt-5 block w-full" v-model="form.email" required
                    autocomplete="username" placeholder="Email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <!-- <InputLabel for="password" value="Password" /> -->

                <TextInput id="password" type="password" class="mt-5 block w-full" v-model="form.password" required
                    autocomplete="new-password" placeholder="Password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <!-- <InputLabel for="password_confirmation" value="Confirm Password" /> -->

                <TextInput id="password_confirmation" type="password" class="mt-5 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <div class="flex items-center mt-5 justify-between">
                <div class="block">
                    <label class="flex items-center">
                        <Checkbox name="terms" checked required v-model:checked="form.terms" />
                        <span class="ml-2 text-sm text-white/50">I agree to
                            <span class="hover:text-white">
                                <a href="#">Terms & conditions</a>
                            </span>
                        </span>
                    </label>
                </div>
            </div>

            <PrimaryButton class="w-full justify-center mt-5" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                Register
            </PrimaryButton>
            <div class="flex items-center justify-center mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-white/50 hover:hover:text-white rounded-md focus:outline-none underline-offset-4">
                Already registered?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
