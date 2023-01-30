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
            selectedPrice: "desc",
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
        } else {
          return new Date(b.created_at) - new Date(a.created_at);
        }
      });
      filtered.sort((a, b) => {
        if (this.selectedPrice === 'asc') {
          return a.price - b.price;
        } else {
          return b.price - a.price;
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
            <div class="flex items-center justify-between">
                <div class="flex flex-col mb-10">
                    <div
                        class="text-myPurple-400 text-base font-semibold uppercase"
                    >
                        Brows
                    </div>
                    <h3 class="text-4xl font-bold">All Nfts</h3>
                </div>

                <div class="flex items-center gap-x-5">
                    <select
                        v-model="selectedBlockchain"
                        class="bg-transparent border-white rounded-full"
                    >
                        <option value="">All</option>
                        <option
                            v-for="blockchain in blockchains"
                            :value="blockchain"
                        >
                            {{ blockchain }}
                        </option>
                    </select>
                    <select
                        v-model="selectedOrder"
                        class="bg-transparent border-white rounded-full capitalize"
                    >
                        <option class="capitalize" value="desc">Newest</option>
                        <option class="capitalize" value="asc">Oldest</option>
                    </select>
                    <select
                        v-model="selectedPrice"
                        class="bg-transparent border-white rounded-full"
                    >
                        <option value="desc">Heighest</option>
                        <option value="asc">Lowest</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-12">
                <div v-for="item in filteredNfts" :key="item.id" class="w-fit">
                    <!-- <NftCard :item="item" /> -->
                    <div class="bg-[#0D0D0D] rounded-2xl relative overflow-hidden">
        <div class="w-[255px] h-[320px]">
            <img :src="item.imgurl" @error="(event) => handleError(event)" alt="" class="min-w-[100%] h-full block rounded-2xl" />
        </div>
        <div class="py-3 px-4">
            <div class="pb-1">
                <Link :href="route('nfts/nft')" method="post" as="button" :data="{ id: item.id }"
                    class="flex items-center gap-x-2 capitalize hover:text-myPurple-400 font-inter font-semibold text-base cursor-pointer">
                {{ truncateString(19, item.name) }}
                <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="#5e45ff" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <path
                                d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z">
                            </path>
                        </svg>
                    </span>
                </Link>
            </div>
            <div class="flex items-center justify-between font-semibold text-myGray /border-t /border-myGray pt-1">
                <div v-if="item.price" class="text-sm uppercase">{{ item.price }} {{ item.blockchain.substring(0,3) }}</div>
                <div v-else class="text-sm uppercase">--</div>
                <div class="text-sm uppercase">{{ dateConvert(item.dropdate).date }}</div>
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
