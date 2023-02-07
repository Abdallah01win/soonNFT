<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navigation from "@/Components/Navigation.vue";
import NftCard from "@/Components/NftCard.vue";
import Footer from "@/Components/Footer.vue";
export default {
    data() {
        return {
            searchTerm: "",
            drop: "",
        };
    },
    props: {
        drops: Object,
    },
    computed: {
        filteredData() {
            const dataArray = Object.values(this.drops);
            return dataArray.filter((item) => {
                return item.name
                    .toLowerCase()
                    .includes(this.searchTerm.toLowerCase());
            });
        },
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
        handleClick(data) {
            this.drop = data;
            const body = document.body;
            body.classList.toggle("overflow-hidden");
            this.$refs.launchpopup.classList.toggle("hidden");
        },
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },
        isImage(link) {
            if (this.drop != '') {
                return !link.endsWith("mp4");
            } else{
                return false;
            }
        },
    },
};
</script>

<template>
    <Head title="Upcoming" />
    <Navigation />

    <section class="mx-auto my-12 max-w-[1180px]">
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div
                    class="text-myPurple-400 text-base font-semibold uppercase"
                >
                    Drops
                </div>
                <h3 class="text-4xl font-bold">All Upcoming</h3>
            </div>
            <input
                type="text"
                class="border-white rounded-full bg-transparent placeholder:text-myGray"
                placeholder="Search"
                v-model="searchTerm"
                @input="searchData"
            />
        </div>
        <div class="grid grid-cols-4 gap-6 mt-8">
            <div v-if="!filteredData.length" class="text-lg text-myGray">
                No upcoming NFTs
            </div>
            <div v-else v-for="item in filteredData" :key="item.symbol">
                <NftCard :item="item" @onClick="handleClick" />
            </div>
        </div>
    </section>
    <Footer />

    <div
        id="launchpopup"
        ref="launchpopup"
        class="bg-myDark-100/70 fixed top-0 left-0 w-full h-screen flex items-center justify-center z-10 hidden"
        @click.self="handleClick('')"
    >
        <div class="bg-[#0D0D0D] rounded-xl p-6 w-[70%] mx-auto">
            <div class="grid grid-cols-[1.5fr,2fr] gap-x-8">
                <div class="w-[100%] rounded-xl overflow-hidden">
                    <img
                        v-if="isImage(drop.image)"
                        :src="drop.image"
                        @error="(event) => handleError(event)"
                        alt=""
                        class="min-w-[100%] h-full block rounded-2xl"
                    />
                    <video
                        v-else
                        :src="drop.image"
                        autoplay
                        loop
                        class="min-w-[100%] h-full block rounded-2xl"
                    />
                </div>
                <div class="flex.flex-col">
                    <div
                        class="flex items-center gap-2 text-3xl font-bold my-3"
                    >
                        {{ drop.name }}
                        <span v-if="drop.featured">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                fill="#5e45ff"
                                viewBox="0 0 256 256"
                            >
                                <rect
                                    width="256"
                                    height="256"
                                    fill="none"
                                ></rect>
                                <path
                                    d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z"
                                ></path>
                            </svg>
                        </span>
                    </div>
                    <div class="text-myGray leading-relaxed mb-3">
                        {{ drop.description }}
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">
                            <span>Supply: </span>
                            <span>{{ drop.size }}</span>
                        </div>

                        <div class="flex items-center gap-x-2 font-semibold">
                            <span>{{
                                dateConvert(drop.launchDatetime).date
                            }}</span>
                            <span>{{
                                dateConvert(drop.launchDatetime).time.slice(
                                    0,
                                    5
                                )
                            }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
