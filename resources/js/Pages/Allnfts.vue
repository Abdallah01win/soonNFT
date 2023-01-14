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
            NftData: Object,
        }
    },
    methods: {
        getAllNfts() {
            axios.get('nfts/all')
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
        this.getAllNfts(this.dataRoute);
    },
}
</script>
<template>

    <Head title="All NFTs" />
    <AuthenticatedLayout class="bg-myDark-300">
        <template v-slot:nav>
            <Navigation class="" />
        </template>
        <section class="mx-auto my-12 max-w-[1180px]">
                <div class="flex flex-col mb-6">
                    <div class="text-myGray text-lg">Brows</div>
                    <h3 class="text-4xl font-bold">All NFTs</h3>
                </div>
            
            <div class="grid grid-cols-4 gap-12">
                <div v-for="item in NftData" :key="item.id" class="w-fit">
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