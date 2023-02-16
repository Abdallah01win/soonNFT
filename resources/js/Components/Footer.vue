<script setup>
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    email: "",
});
</script>
<template>
    <footer
        class="mx-auto pt-10 px-[8%] sm:px-0 max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px] border-t border-myDark-100 text-sm sm:text-base"
    >
        <div class="mb-4 w-fit">
            <Link :href="route('/')" class="w-fit">
                <img src="/storage/assets/Logo.svg" class="w-[220px] sm:w-[260px] md:w-[380px]"/>
            </Link>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[1.5fr,0.5fr] lg:grid-cols-[2.5fr,0.7fr,1.8fr] gap-x-4 gap-y-6 lg:gap-x-6">
            <div>
                <p class="mb-4 font-light md:w-[85%]">
                    Our mission is to provide a reliable source of NFT news and
                    information and a platform for discovering digital art in a
                    user-friendly environment.
                </p>
                <div>
                    <h4 class="font-semibold mb-1 sm:text-base md:text-lg">Get in Touch</h4>
                    <p class="flex gap-x-2 items-center py-1">
                        <ion-icon name="mail-outline"></ion-icon>
                        <span>contact@soonnft.com</span>
                    </p>
                    <p class="flex gap-x-2 items-center py-1">
                        <ion-icon name="call-outline"></ion-icon>
                        <span>080089656</span>
                    </p>
                </div>
            </div>
            <div>
                <h4 class="font-semibold mb-2 sm:text-base md:text-lg">Navigate</h4>
                <ul class="flex flex-col gap-y-2 font-light">
                    <li class="hover:text-myPurple-400 w-fit">
                        <Link :href="route('blog')">Blog </Link>
                    </li>
                    <li class="hover:text-myPurple-400 w-fit">
                        <Link :href="route('nfts/all')">NFTs </Link>
                    </li>
                    <li class="hover:text-myPurple-400 w-fit">
                        <Link :href="route('upcoming')">Upcoming</Link>
                    </li>
                    <li class="hover:text-myPurple-400 w-fit">
                        <Link :href="route('/collections')">Collections </Link>
                    </li>
                </ul>
            </div>
            <div class="w-full">
                <h4 class="font-semibold mb-2 sm:text-base md:text-lg">Community</h4>
                <p class="mb-3 font-light">
                    Join our community on any social media
                </p>

                <div class="flex items-center gap-x-2 mb-6">
                    <div class="grow">
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
                <Link v-if="!$page.props.auth.user" :href="route('login')" class="w-full block text-center px-12 py-3 rounded-full bg-myPurple-400 text-white cursor-pointer font-semibold hover:bg-myPurple-300">Creat Your Account Now</Link>
            </div>
        </div>
        <div
            class="border-t border-myDark-100 text-myGray py-3 mt-4 lg:mt-10 flex flex-col sm:flex-row items-center justify-between"
        >
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
