<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>

<script>
export default {
    methods: {
        toggelNav() {
            const body = document.body;
            body.classList.toggle("overflow-hidden");
            this.$refs.nav.classList.toggle('h-[100vh]');
            this.$refs.mobileNav.classList.toggle('hidden');
        },
    }
}
</script>


<template>
    <div ref="nav" class="">
        <nav class="flex justify-between items-center py-3 md:py-4 mx-auto border-b border-myDark-100
                max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px] max-sm:mx-[8%]">
            <div class="font-inter text-xl lg:text-2xl font-extrabold">
                <Link :href="route('/')" class="w-fit">
                <img src="/storage/assets/Logo.svg" class="w-[115px] sm:w-[130px] md:w-[150px]" />
                </Link>
            </div>
            <ul class="hidden lg:flex items-center gap-x-8 leading-relaxed ">
                <li class="hover:text-myPurple-400 cursor-pointer transition-all">
                    <Link :href="route('nfts/all')" class="text-white/50">NFTs</Link>
                </li>
                <li class="hover:text-myPurple-400 cursor-pointer transition-all">
                    <Link :href="route('/collections')" class="text-white/50">Collections</Link>
                </li>
                <li class="hover:text-myPurple-400 cursor-pointer transition-all">
                    <Link :href="route('upcoming')" class="text-white/50">Upcoming</Link>
                </li>
                <li class="hover:text-myPurple-400 cursor-pointer transition-all">
                    <Link :href="route('blog')" class="text-white/50">Blog</Link>
                </li>
                <li v-if="$page.props.auth.user && $page.props.auth.user.type === 1"
                    class="hover:text-myPurple-400 cursor-pointer transition-all">
                    <Link :href="route('dashboard')" class="text-white/50">Dashboard</Link>
                </li>
            </ul>
            <div class="hidden lg:flex">
                <div v-if="!$page.props.auth.user" class="text-sm lg:text-base">
                    <Link :href="route('login')" class="rounded-full py-1 md:py-2 px-5 md:px-8 lg:px-10 uppercase bg-myPurple-400 
            hover:bg-myPurple-300 transition-all">Log in
                    </Link>
                </div>
                <div v-else>
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex items-center rounded-md">
                                <button type="button"
                                    class="inline-flex items-center bg-transparent transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
            <div class="max-lg:flex hidden" @click="toggelNav">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="32px" viewBox="0 0 512 512">
                    <title>Reorder Three</title>
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="32" d="M96 256h320M96 176h320M96 336h320" />
                </svg>
            </div>
        </nav>
        <div ref="mobileNav"
            class="h-full flex flex-col justify-between pb-8 max-w-full hidden lg:hidden max-sm:mx-[8%] transition-all max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] mx-auto">
            <ul class="flex flex-col leading-relaxed ">
                <li class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('/')">Home</Link>
                </li>
                <li class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('nfts/all')">NFTs</Link>
                </li>
                <li class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('/collections')">Collections</Link>
                </li>
                <li class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('upcoming')">Upcoming</Link>
                </li>
                <li class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('blog')">Blog</Link>
                </li>
                <li v-if="$page.props.auth.user && $page.props.auth.user.type === 1"
                    class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('dashboard')">Dashboard</Link>
                </li>
                <li v-if="$page.props.auth.user"
                    class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('profile.edit')">Profile</Link>
                </li>
                <li v-if="$page.props.auth.user"
                    class="border-b border-myDark-100 cursor-pointer transition-all py-2">
                    <Link :href="route('logout')">Log Out</Link>
                </li>
            </ul>

            <div v-if="!$page.props.auth.user" class="flex w-full gap-x-4 mt-auto ">
                <Link :href="route('login')" class="rounded-full py-1 md:py-2 px-5 md:px-8 lg:px-10 uppercase bg-myPurple-400 hover:bg-myPurple-300 transition-all w-full text-center">Log in
                </Link>
                <Link :href="route('register')" class="rounded-full py-1 md:py-2 px-5 md:px-8 lg:px-10 uppercase bg-myPurple-400 hover:bg-myPurple-300 transition-all w-full text-center">Register
                </Link>
            </div>
        </div>
    </div>
</template>