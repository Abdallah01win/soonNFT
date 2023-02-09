<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Navigation from "@/Components/Navigation.vue";
import Footer from "@/Components/Footer.vue";
import NftCard from "@/Components/NftCard.vue";
import axios from "axios";
</script>

<script>
export default {
    data() {
        return {
            selectedBlockchain: "",
            selectedOrder: "desc",
            blockchains: [],
        };
    },
    props: {
        NftData: Object,
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
        SelectedOrder(option) {
            this.selectedOrder = option;
        },
        SelectedBlockchain(option) {
            this.selectedBlockchain = option;
        },
    },
    computed: {
        filteredNfts() {
            let filtered = this.NftData;

            if (this.selectedBlockchain) {
                filtered = filtered.filter(nft => nft.blockchain === this.selectedBlockchain);
            }

            filtered.sort((a, b) => {
                if (this.selectedOrder === 'asc') {
                    return new Date(a.created_at) - new Date(b.created_at);
                } else if (this.selectedOrder === 'desc') {
                    return new Date(b.created_at) - new Date(a.created_at);
                } else if (this.selectedOrder === 'heighest') {
                    return b.price - a.price;
                } else if (this.selectedOrder === 'lowest') {
                    return a.price - b.price;
                }
            });

            return filtered;
        }
    },
    mounted() {
        this.blockchains = [...new Set(this.NftData.map(nft => nft.blockchain))];
    },
};
</script>
<template>

    <Head title="All NFTs" />
    <AuthenticatedLayout class="bg-myDark-300">
        <template v-slot:nav>
            <Navigation class="" />
        </template>
        <section class="mx-auto my-12 max-w-[1180px]">
            <div class="flex items-center justify-between mb-10">
                <div class="flex flex-col">
                    <div class="text-myPurple-400 text-base font-semibold uppercase">
                        Brows
                    </div>
                    <h3 class="text-4xl font-bold">All Nfts</h3>
                </div>

                <div class="flex items-center gap-x-5">

                    <div
                    class="relative text-sm flex border-[3px] border-myPurple-400 bg-transparent rounded-full py-2 px-2 /font-semibold leading-relaxed">
                    <button @click="SelectedBlockchain('')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': '' === selectedBlockchain}">
                        All
                    </button>
                    <button v-for="(option, index) in blockchains" :key="index" @click="SelectedBlockchain(option)"
                        class="py-1 px-5 rounded-full transition-colors capitalize"
                        :class="{ 'bg-myPurple-400': option === selectedBlockchain }">
                        {{ option }}
                    </button>
                </div>

                    <div
                    class="relative text-sm flex border-[3px] border-myPurple-400 bg-transparent rounded-full py-2 px-2 /font-semibold leading-relaxed">
                    <button @click="SelectedOrder('desc')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': 'desc' === selectedOrder }">
                        Newest
                    </button>
                    <button @click="SelectedOrder('asc')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': 'asc' === selectedOrder }">
                        Oldest
                    </button>
                    <button @click="SelectedOrder('heighest')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': 'heighest' === selectedOrder }">
                        heighest
                    </button>
                    <button @click="SelectedOrder('lowest')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': 'lowest' === selectedOrder }">
                        lowest
                    </button>
                </div>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-12">
                <div v-for="item in filteredNfts" :key="item.id" class="w-fit">
                    <div class="bg-[#0D0D0D] rounded-2xl relative overflow-hidden">
                        <div class="w-[255px] h-[255px]">
                            <img :src="item.imgurl" @error="(event) => handleError(event)" alt=""
                                class="min-w-[100%] h-full block rounded-2xl" />
                        </div>
                        <div class="py-3 px-4">
                            <div class="pb-1">
                                <Link :href="route('nfts/nft')" method="post" as="button" :data="{ id: item.id }"
                                    class="flex items-center gap-x-2 capitalize hover:text-myPurple-400 font-inter font-semibold text-base cursor-pointer">
                                {{ truncateString(19, item.name) }}
                                <span v-if="item.is_featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="#5e45ff"
                                        viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none"></rect>
                                        <path
                                            d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z">
                                        </path>
                                    </svg>
                                </span>
                                </Link>
                            </div>
                            <div
                                class="flex items-center justify-between font-semibold text-myGray /border-t /border-myGray pt-1">
                                <div v-if="item.price" class="text-sm uppercase">{{ item.price }} {{
                                    item.blockchain.substring(0, 3)
                                }}</div>
                                <div v-else class="text-sm uppercase">--</div>
                                <div class="text-sm uppercase">{{ dateConvert(item.created_at).date }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Footer />
    </AuthenticatedLayout>
</template>

<style>
.custom-options {
    background-image: url('/storage/svg/options-outline.svg');
    background-repeat: no-repeat;
    background-position: right 13px top 50%;
}

.custom-select {
    background-image: url('/storage/svg/arrow-d.svg');
    background-repeat: no-repeat;
    background-position: right 13px top 50%;
}

.nft-card-det {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(50px);
    -webkit-backdrop-filter: blur(50px);
}

.nft-card:hover .nft-card-chain {
    display: grid !important;
}

.news-letter-sub {
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(50px);
    -webkit-backdrop-filter: blur(50px);
}

.splide__pagination {
    display: none !important;
}
</style>
