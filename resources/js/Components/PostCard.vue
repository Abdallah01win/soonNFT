<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<script>
export default {
    data() {
        return {
            //fallbackImage: "/storage/assets/hero2.png",
            hover: false
        }
    },
    props: {
        item: Object,
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },
        truncateString(num, str) {
            if (str.length > num) {
                return str.substring(0, num) + "...";
            } else {
                return str;
            }
        },
        handleError(event) {
            event.target.setAttribute('src', this.fallbackImage)
        },
    },
}
</script>

<template>
    <div class="w-full">
        <div class="relative" @mouseover="hover = true" @mouseleave="hover = false">
            <img :src="item.image" alt=""
                class="w-full h-[170px] lg:h-[200px] xl:h-[220px] rounded-3xl overflow-hidden">
            <div v-if="hover"
                class="transition-all absolute top-0 left-0 flex items-center justify-center w-full h-full bg-myDark-100/60 rounded-3xl">
                <Link :href="route('post')" method="post" as="button" :data="{ id: item.id }">
                <div
                    class="w-16 h-16 rounded-full bg-myPurple-400 hover:bg-myPurple-300 text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="28px" fill="#fff"
                        viewBox="0 0 512 512">
                        <title>Navigate</title>
                        <path
                            d="M272 464a16 16 0 01-16-16.42V264.13a8 8 0 00-8-8H64.41a16.31 16.31 0 01-15.49-10.65 16 16 0 018.41-19.87l384-176.15a16 16 0 0121.22 21.19l-176 384A16 16 0 01272 464z" />
                    </svg>
                </div>
                </Link>
            </div>
        </div>
        <div class="leading-relaxed py-3 md:py-5 px-0 sm:px-2">
            <div class="text-myPurple-400 text-xs sm:text-sm lg:text-base font-semibold">{{ item.category }}</div>
            <div class="sm:text-sm md:text-base lg:text-lg xl:text-xl font-semibold mb-2 md:mb-3 capitalize">{{
                item.title }}</div>
            <p class="text-sm lg:text:base text-myGray mb-2 md:mb-3 capitalize">
                {{ truncateString(100, item.description)}}
            </p>
            <div class="flex items-center">
                <img alt="testimonial" :src="item.image_url"
                    class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center" />
                <span class="flex-grow flex flex-col pl-4">
                    <span class="title-font text-sm font-medium">{{ item.name }}</span>
                    <span class="text-xs text-myGray font-semibold">{{ dateConvert(item.created_at).date }}</span>
                </span>
            </div>
        </div>
    </div>
</template>