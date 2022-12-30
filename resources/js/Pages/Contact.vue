<script setup>
import Footer from "@/Components/Footer.vue";
import Navigation from "@/Components/Navigation.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
</script>
<script>
const form = useForm({
    name: "",
    email: "",
    message: "",
    terms: true,
});
const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

export default {
    components: {
        Navigation,
        Footer,
        Head,
    },
};
</script>
<template>
    <Head title="Contact" />
    <!-- <Navigation /> -->

    <main class="main">
        <Navigation />
        <section
            class="flex items-center h-[100vh] max-h-[610px] mx-auto max-w-[1180px]"
        >
            <div
                class="contact-form-bg w-[65%] mx-auto rounded-2xl py-16 px-16"
            >
                <div class="mb-4">
                    <Link
                        :href="route('/')"
                        class="block w-fit cursor-pointer font-inter text-4xl font-extrabold uppercase mb-2"
                    >
                        Let's Get in Touch</Link
                    >
                    <p class="text-white/50">
                        Lorem ipsum dolor sit, amet consectetur adipisicing
                        elit.
                    </p>
                </div>
                <form @submit.prevent="submit">
                    <div class="flex items-center gap-x-3">
                    <div class="w-full">
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-5 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="w-full">
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-5 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </div>

                    <div class="mt-4">
                        <textarea
                            id="message"
                            class="mt-6 h-28 block w-full border-white focus:border-white focus:ring-white rounded-xl bg-transparent placeholder:text-white/50 pl-5"
                            
                            v-model="form.message"
                            required
                            autocomplete="message"
                            placeholder="Your message"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.message"
                        />
                    </div>
                    <div class="flex items-center mt-5 justify-between">
                        <div class="block">
                            <label class="flex items-center">
                                <Checkbox
                                    name="terms"
                                    checked
                                    required
                                    v-model:checked="form.terms"
                                />
                                <span class="ml-2 text-sm text-white/50"
                                    >I agree to
                                    <span class="hover:text-white">
                                        <a href="#">Terms & conditions</a>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="flex items-center">
                                <Checkbox
                                    name="newsLetter"
                                    checked
                                    v-model:checked="form.newsLetter"
                                />
                                <span class="ml-2 text-sm text-white/50"
                                    >Signup to newsLetter</span
                                >
                            </label>
                        </div>
                    </div>

                    <PrimaryButton
                        class="w-full justify-center mt-5"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Send
                    </PrimaryButton>
                </form>
            </div>
        </section>
    </main>

    <Footer class="mt-12" />
</template>

<style>
.main {
    background-color: #000000;
    background-image: radial-gradient(
            at 76% 58%,
            hsla(267, 94%, 59%, 1) 0,
            hsla(267, 94%, 59%, 0) 50%
        ),
        radial-gradient(
            at 42% 45%,
            hsla(239, 91%, 66%, 1) 0,
            hsla(239, 91%, 66%, 0) 50%
        ),
        radial-gradient(
            at 64% 38%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%
        ),
        radial-gradient(
            at 2% 32%,
            hsla(313, 85%, 61%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%
        ),
        radial-gradient(
            at 26% 55%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%
        ),
        radial-gradient(
            at 42% 59%,
            hsla(221, 90%, 52%, 1) 0,
            hsla(221, 90%, 52%, 0) 50%
        );
}

.contact-form-bg {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(60px);
    -webkit-backdrop-filter: blur(50px);
}
</style>
