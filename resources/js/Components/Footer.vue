<script setup>
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const form = useForm({
    email: '',
});

</script>
<template>
    <footer class="mx-auto mt-28 pt-10 max-w-[1180px] border-t border-myDark-100">
        <div class="text-5xl uppercase font-black mb-4">
            <Link :href="route('/')">Soonnft</Link>
            </div>
        <div class="grid grid-cols-[2.5fr,0.7fr,1.8fr] gap-x-6">
            <div>
                <p class="mb-4 font-light w-[85%]">
                    Our mission is to provide a reliable source of NFT news and information and a platform for discovering digital art in a user-friendly environment.
                </p>
                <div>
                    <h4 class="font-semibold mb-1 text-lg ">Get in Touch</h4>
                    <p class="flex gap-x-2 items-center py-1">
                        <ion-icon name="mail-outline"></ion-icon>
                        <span>contact@soonnft.com</span>
                    </p>
                    <p class="flex gap-x-2 items-center py-1">
                        <ion-icon name="call-outline"></ion-icon>
                        <span>080089656</span>
                    </p>
                    <p class="flex gap-x-2 items-center py-1">
                        <ion-icon name="location-outline"></ion-icon>
                        <span class="">5th-AV NewYourk City - USA</span>
                    </p>
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-2 text-lg">Useful Links</h4>
                <ul class="flex flex-col gap-y-2 font-light">
                    <li>Blog</li>
                    <li>Etherum</li>
                    <li>Solana</li>
                    <li>
                        <Link :href="route('contact')">Contact</Link>
                    </li>
                    <li>Help</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-2 text-lg ">Community</h4>
                <p class="mb-3 font-light">Lorem ipsum dolor sit. Lorem ipsum dolor.</p>

                <form action="post" class="flex items-center gap-x-2 mb-6">
                    <div class="grow">
                        <TextInput
                            id="footerEmail"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <PrimaryButton
                        class="w-fit justify-center px-5"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Subscribe
                    </PrimaryButton>
                </form>

                <div class="flex gap-4 items-center text-2xl">
                    <span class="hover:cursor-pointer">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </span>
                    <span class="hover:cursor-pointer">
                        <ion-icon name="logo-youtube"></ion-icon>
                    </span>
                    <span class="hover:cursor-pointer">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </span>
                    <span class="hover:cursor-pointer">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </span> 
                    <span class="hover:cursor-pointer">
                        <ion-icon name="logo-discord"></ion-icon>
                </span>
                </div>
            </div>
        </div>
        <div class="border-t border-myDark-100 text-myGray py-3 mt-10 flex items-center justify-between">
            <div>&copy; - 2022 SoonNFT, Inc</div>
            <div class="flex gap-3">
                <span class="cursor-pointer hover:text-white">
                    <a href="#">Privacy Policy</a>
                </span>
                <span class="cursor-pointer hover:text-white">
                    <a href="#">Terms of Service</a>
                </span>
            </div>
        </div>
    </footer>
</template>