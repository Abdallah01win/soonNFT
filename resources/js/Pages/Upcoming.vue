<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import NftCard from "@/Components/NftCard.vue";
import Footer from '@/Components/Footer.vue';
export default {
    data() {
        return {

        }
    },
    props: {
        drops: Object,
    },
    computed: {
        filteredData() {
            const dataArray = Object.values(this.cols);
            return dataArray.filter(item => {
                return item.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        }
    },
    components: {
        Navigation,
        Footer,
        NftCard,
        Head,
    },
    methods: {
        truncateString(num, str) {
            if (str.length > num) {
                return str.substring(0, num) + "...";
            } else {
                return str;
            }
        },
        showPopup(col) {
            this.col = col;
            const body = document.body;
            body.classList.toggle("overflow-hidden");
            this.$refs.popup.classList.toggle("hidden");
        },
    }
}
</script>

<template>

    <Head title="Upcoming" />
    <Navigation />

    <section class="mx-auto my-12 max-w-[1180px] ">
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div class="text-myPurple-400 text-base font-semibold uppercase">
                    Drops
                </div>
                <h3 class="text-4xl font-bold">All Upcoming</h3>
            </div>
            <input type="text" class="border-white rounded-full bg-transparent placeholder:text-myGray"
                placeholder="Search" v-model="searchTerm" @input="searchData" />
        </div>
        <div class="grid grid-cols-4 gap-6 mt-8">
            <div v-for="item in drops" :key="item.symbol">
                <NftCard :item="item" />
            </div>
        </div>
    </section>
    <Footer />
</template>