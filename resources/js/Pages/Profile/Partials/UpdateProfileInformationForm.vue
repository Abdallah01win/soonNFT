<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.value.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    image: "",
});
</script>
<script>
export default {
    data() {
        return {
            user: usePage().props.value.auth.user,
        }
    }
}
</script>

<template>
    <section class="">

        <div class="">
            <form @submit.prevent="form.post(route('profile.update'))" class="/mt-6  grid grid-cols-[1fr,.7fr] gap-x-8">
                <div class="space-y-6 sm:pr-6 lg:pr-8">
                    <header>
                        <h2 class="text-lg font-medium">Profile Information</h2>

                        <p class="mt-1 text-sm text-myGray">
                            Update your account's profile information and email address.
                        </p>
                    </header>
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autofocus autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            disabled autocomplete="email" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="
                        props.mustVerifyEmail && user.email_verified_at === null
                    ">
                        <p class="text-sm mt-2 text-gray-800">
                            Your email address is unverified.
                            <Link :href="route('verification.send')" method="post" as="button"
                                class="underline text-sm text-myGray hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="props.status === 'verification-link-sent'"
                            class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email
                            address.
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <PrimaryButton :disabled="form.processing" class="w-1/3 justify-center">Save</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                            class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful"
                                class="text-sm text-white font-semibold bg-green-600 py-1 px-4 rounded-full">
                                Profile Saved.
                            </p>
                        </Transition>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <div class="relative">
                        <div class="overflow-hidden rounded-full">
                            <img v-if="!user.image_url" src="https://dummyimage.com/106x106" alt=""
                                class="rounded-full w-44 h-44 cursor-pointer" />
                            <img v-else :src="user.image_url" alt="" class="rounded-full w-44 h-44 cursor-pointer" />
                        </div>
                        <div
                            class="absolute flex items-center justify-center bottom-[2%] right-[8%] w-10 h-10 rounded-full overflow-hidden bg-myPurple-400 hover:bg-myPurple-300 z-10 cursor-pointer border-4 border-myDark-400">
                            <Input class="absolute h-full w-full top-0 left-0 opacity-0" type="file"
                                @input="form.image = $event.target.files[0]"></Input>

                            <span class="w-5" v-if="form.image === ''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 520 520">
                                    <title>Cloud Upload</title>
                                    <path
                                        d="M320 367.79h76c55 0 100-29.21 100-83.6s-53-81.47-96-83.6c-8.89-85.06-71-136.8-144-136.8-69 0-113.44 45.79-128 91.2-60 5.7-112 43.88-112 106.4s54 106.4 120 106.4h56"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="32" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32"
                                        d="M320 255.79l-64-64-64 64M256 448.21V207.79" />
                                </svg>
                            </span>
                            <span v-else class="w-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 520 520">
                                    <title>Cloud Done</title>
                                    <path
                                        d="M400 240c-8.89-89.54-71-144-144-144-69 0-113.44 48.2-128 96-60 6-112 43.59-112 112 0 66 54 112 120 112h260c55 0 100-27.44 100-88 0-59.82-53-85.76-96-88z"
                                        fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="32" d="M317 208L209.2 336 163 284.8" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>
