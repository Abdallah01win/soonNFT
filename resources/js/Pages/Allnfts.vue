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
                    <NftCard :item="item" />
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
