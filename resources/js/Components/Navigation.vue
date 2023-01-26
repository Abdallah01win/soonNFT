<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>
<template>
    <nav class="flex justify-between items-center py-5 mx-auto max-w-[1180px]">
        <div class="font-inter text-2xl font-extrabold">
            <Link :href="route('/')">SOONNFT</Link>
        </div>
        <ul class="flex items-center gap-x-8 font-semibold leading-relaxed">
            <li class="hover:text-myPurple-400 cursor-pointer transition-all">Ethereum</li>
            <li class="hover:text-myPurple-400 cursor-pointer transition-all">Solana</li>
            <li class="hover:text-myPurple-400 cursor-pointer transition-all">Upcoming</li>
            <li class="hover:text-myPurple-400 cursor-pointer transition-all">
                <Link :href="route('blog')">Blog</Link>
            </li>
            <li v-if="$page.props.auth.user && $page.props.auth.user.type === 1" class="hover:text-myPurple-400 cursor-pointer transition-all">
                <Link :href="route('dashboard')">Dashboard</Link>
            </li>
        </ul>
        <div v-if="!$page.props.auth.user" class="flex items-center gap-x-4 text-base">
            <Link :href="route('login')" class="rounded-full py-2 px-10 uppercase bg-myPurple-400 
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

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
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
    </nav>
</template>