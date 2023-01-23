<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<script>
export default {
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
        }
    },
}
</script>
<template>
    <!-- <div class="relative overflow-hidden rounded-2xl w-[255px] h-[320px] nft-card">
                <img :src="item.imgurl" alt="" class="min-w-[100%] max-h-[400px] min-h-full block" />
                <div class="nft-card-det flex justify-between items-center py-3 px-5 w-full absolute left-0 bottom-0">
                    <div class="flex flex-col  ">
                        <Link
                            :href="route('nfts/nft')"
                            method="post"
                            as="button"
                            :data="{ id: item.id }" class="capitalize hover:underline underline-offset-4 cursor-pointer font-bold">
                            {{ item.name }}
                        </Link>
                        <span class="text-xs">{{ dateConvert(item.dropdate).date }}</span>
                    </div>
                    <div class="text-sm uppercase">{{ item.price }} {{ item.blockchain.substr(0, 3) }}</div>
                </div>
                <div
                    class="nft-card-chain nft-card-det absolute top-0 right-0 mt-3 mr-5 p-2 grid place-content-center rounded-full hidden cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#000000" viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none"></rect>
                        <path
                            d="M133.7,211.9l81-81c19.9-20,22.8-52.7,4-73.6a52,52,0,0,0-75.5-2.1L128,70.5,114.9,57.3c-20-19.9-52.7-22.8-73.6-4a52,52,0,0,0-2.1,75.5l83.1,83.1A8.1,8.1,0,0,0,133.7,211.9Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="12"></path>
                    </svg>
                </div>
            </div> -->

    <div class="bg-[#0D0D0D] rounded-2xl relative overflow-hidden">
        <div class="w-[255px] h-[320px]">
            <img :src="item.image" alt="" class="min-w-[100%] h-full block rounded-2xl" />
        </div>
        <div class="py-3 px-4">
            <div class="pb-1">
                <Link :href="route('nfts/nft')" method="post" as="button" :data="{ id: item.symbol }"
                    class="flex items-center gap-x-2 capitalize hover:text-myPurple-400 font-inter font-semibold text-base cursor-pointer">
                {{ truncateString(19, item.name) }}
                <span v-if="item.featured">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#5e45ff" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <path
                                d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z">
                            </path>
                        </svg>
                    </span>
                </Link>
            </div>
            <div class="flex items-center justify-between font-semibold text-myGray /border-t /border-myGray pt-1">
                <div v-if="item.price" class="text-sm uppercase">{{ item.price }} SOL</div>
                <div v-else class="text-sm uppercase">--</div>
                <div class="text-sm uppercase">{{ dateConvert(item.launchDatetime).date }}</div>
            </div>
        </div>
    </div>
</template>