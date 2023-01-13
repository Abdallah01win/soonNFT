<script setup>
import axios from "axios";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import { Link } from "@inertiajs/inertia-vue3";
import '@splidejs/vue-splide/css';
</script>
<script>
export default {
    props: {
        dataRoute: String,
        nftId: '',
    },
    data() {
        return {
            NftData: Object,
        }
    },
    components: {
        Splide,
        SplideSlide,
        Link,
    },
    computed:{
        removeCurrentNft(){
            if(this.nftId !== ''){
            return  this.NftData.filter(nft => nft.id !== this.nftId)
            } else {
                return this.NftData;
            }
        }
    },
    methods: {
        getData(route) {
            axios
                .get(route)
                .then((response) => (this.NftData = response.data));
        },
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },
    },
    mounted() {
        this.getData(this.dataRoute);
    },
}
</script>

<template>
    <Splide :options="{
        rewind: true,
        autoWidth: true,
        focus: 'center',
        perPage: 4,
        perMove: 2,
        gap: '2em',
        padding: '4rem',
    }" :classes="{
    pagination: 'splide__pagination no-pagination',
}" aria-label="Viral Nfts">
        <SplideSlide v-for="item in removeCurrentNft" :key="item.id">
            <div class="relative overflow-hidden rounded-2xl w-[255px] h-[340px] nft-card">
                <img :src="item.imgurl" alt="" class="min-w-[100%] max-h-[400px] block" />
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
            </div>
        </SplideSlide>
    </Splide>
</template>