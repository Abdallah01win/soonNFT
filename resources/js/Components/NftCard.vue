<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
<script>
export default {
    data() {
        return {
            fallbackImage: "/storage/assets/hero2.png",
        };
    },
    props: {
        item: Object,
        handleClick: {
            type: Function,
            required: true,
        },
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
            event.target.setAttribute("src", this.fallbackImage);
        },
        handleClick() {
            this.$emit("onClick", this.item);
        },
    },
};
</script>
<template>
    <div class="bg-[#0D0D0D] rounded-2xl relative overflow-hidden">
        <div class="w-[255px] h-[320px]">
            <img
                :src="item.image"
                @error="(event) => handleError(event)"
                alt=""
                class="min-w-[100%] h-full block rounded-2xl"
            />
        </div>
        <div class="py-3 px-4">
            <div class="pb-1">
                <div @click="handleClick"
                    class="flex items-center gap-x-2 capitalize
                    hover:text-myPurple-400 font-inter font-semibold text-base
                    cursor-pointer">
                    {{ truncateString(19, item.name) }}
                    <span v-if="item.featured">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            fill="#5e45ff"
                            viewBox="0 0 256 256"
                        >
                            <rect width="256" height="256" fill="none"></rect>
                            <path
                                d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z"
                            ></path>
                        </svg>
                    </span>
                </div>
            </div>
            <div
                class="flex items-center justify-between font-semibold text-myGray /border-t /border-myGray pt-1"
            >
                <div v-if="item.price" class="text-sm uppercase">
                    {{ item.price }} SOL
                </div>
                <div v-else class="text-sm uppercase">--</div>
                <div class="text-sm uppercase">
                    {{ dateConvert(item.launchDatetime).date }}
                </div>
            </div>
        </div>
    </div>
</template>
