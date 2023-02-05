<script setup>
import { onMounted } from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Dialog from "@/Components/Dialog.vue";
import Footer from "@/Components/Footer.vue";
import Navigation from "@/Components/Navigation.vue";
import NftSlider from "@/Components/NftSlider.vue";
import PostCard from "@/Components/PostCard.vue"
//import Pagination from "@/Components/Pagination.vue";
import axios from "axios";
const form = useForm({
    email: "",
});
</script>
<script>
export default {
    data() {
        return {
            nftId: Number,
            col: "",
        };
    },
    props: {
        nfts: Object,
        cols: Object,
        drops: Object,
        posts: Object,
        dropsCount: Number,
        featuredCount: Number,
    },
    components: {
        Footer,
        Navigation,
        PrimaryButton,
        PrimaryButton,
        PostCard,
        Link,
        Dialog,
        NftSlider,
        Head,
    },
    methods: {
        close(id) {
            this.nftId = id;
            console.log("clicked destroy", id);
            const confirmDelete = document.getElementById("confirmDelete");
            const body = document.body;
            body.classList.toggle("overflow-hidden");
            confirmDelete.classList.toggle("hidden");
        },
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
        showPopup(col) {
            this.col = col;
            const body = document.body;
            body.classList.toggle("overflow-hidden");
            this.$refs.popup.classList.toggle("hidden");
        },
    },
};
</script>

<template>
    
    <div
        id="popup"
        ref="popup"
        class="bg-myDark-100/70 fixed top-0 left-0 w-full h-screen flex items-center justify-center z-10 hidden"
        @click.self="showPopup('')"
    >
        <div class="bg-[#0D0D0D] rounded-xl p-6 w-[70%] mx-auto">
            <div class="grid grid-cols-[1.5fr,2fr] gap-x-8">
                <div class="w-[100%] rounded-xl overflow-hidden">
                    <img :src="col.image" alt="" />
                </div>
                <div class="flex.flex-col">
                    <div
                        class="flex items-center gap-2 text-3xl font-bold my-3"
                    >
                        {{ col.name }}
                        <span v-if="col.isBadged">
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
                        {{ col.description }}
                    </div>
                    <div class="mt-4 mb-2 font-semibold">Links:</div>
                    <div class="flex itams-center gap-x-3">
                        <span v-if="col.website">
                            <a
                                :href="col.website"
                                target="_blank"
                                class="hover:text-white block"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="ionicon"
                                    width="26px"
                                    height="26px"
                                    viewBox="0 0 512 512"
                                >
                                    <title>Globe</title>
                                    <path
                                        d="M256 48C141.13 48 48 141.13 48 256s93.13 208 208 208 208-93.13 208-208S370.87 48 256 48z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-miterlimit="10"
                                        stroke-width="32"
                                    />
                                    <path
                                        d="M256 48c-58.07 0-112.67 93.13-112.67 208S197.93 464 256 464s112.67-93.13 112.67-208S314.07 48 256 48z"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-miterlimit="10"
                                        stroke-width="32"
                                    />
                                    <path
                                        d="M117.33 117.33c38.24 27.15 86.38 43.34 138.67 43.34s100.43-16.19 138.67-43.34M394.67 394.67c-38.24-27.15-86.38-43.34-138.67-43.34s-100.43 16.19-138.67 43.34"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="32"
                                    />
                                    <path
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-miterlimit="10"
                                        stroke-width="32"
                                        d="M256 48v416M464 256H48"
                                    />
                                </svg>
                            </a>
                        </span>
                        <span v-if="col.twitter">
                            <a
                                :href="col.twitter"
                                target="_blank"
                                class="hover:text-white font-sm block"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 30 30"
                                    width="28px"
                                    height="28px"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z"
                                    />
                                </svg>
                            </a>
                        </span>
                        <span v-if="col.discord">
                            <a
                                :href="col.discord"
                                target="_blank"
                                class="hover:text-white block"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 72 72"
                                    width="28px"
                                    height="28px"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M54.657,19.077c0,0,8.343,9.663,8.343,27.069v3.65c0,0-10.536,6.866-13.747,6.866l-3.115-4.529	c1.936-0.867,4.577-2.372,4.577-2.372l-0.965-0.747c0,0-6.173,2.86-13.749,2.86s-13.749-2.86-13.749-2.86l-0.965,0.747	c0,0,2.641,1.505,4.577,2.372l-3.115,4.529C19.536,56.662,9,49.796,9,49.796v-3.65c0-17.406,8.343-27.069,8.343-27.069	s5.707-2.762,10.977-3.489l1.635,3.1c0,0,2.599-0.602,6.045-0.602s6.045,0.602,6.045,0.602l1.635-3.1	C48.95,16.315,54.657,19.077,54.657,19.077z M27.01,43.603c2.656,0,4.808-2.418,4.808-5.401c0-2.983-2.153-5.401-4.808-5.401	s-4.808,2.418-4.808,5.401C22.202,41.185,24.354,43.603,27.01,43.603z M44.99,43.603c2.656,0,4.808-2.418,4.808-5.401	c0-2.983-2.153-5.401-4.808-5.401c-2.656,0-4.808,2.418-4.808,5.401C40.182,41.185,42.334,43.603,44.99,43.603z"
                                    />
                                </svg>
                            </a>
                        </span>
                    </div>

                    <div v-if="col.categories && col.categories.length != 0">
                        <div class="mt-4 mb-2 font-semibold">Categories:</div>
                        <div class="flex items-center gap-x-2">
                            <div v-for="category in col.categories" :key="category">
                                <div
                                    class="py-1 px-3 bg-myPurple-400 rounded-full text-sm font-semibold capitalize"
                                    v-if="category === 'launchpad'"
                                >
                                    Upcoming
                                </div>
                                <div
                                    v-else
                                    class="py-1 px-3 bg-myPurple-400 rounded-full text-sm font-semibold capitalize"
                                >
                                    {{ category }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Head title="Home" />

    <main class="main">
        <Navigation />
        <section
            class="grid grid-cols-2 gap-x-10 /h-[100vh] max-h-[620px] mx-auto max-w-[1180px] py-10"
        >
            <div class="flex flex-col justify-center">
                <h1 class="font-inter font-black text-6xl mb-3 uppercase">
                    Unlocking a New Dimension of
                    <span class="text-myPurple-400">NFT Collection</span>
                </h1>
                <p class="text-myGray text-lg leading-relaxed">
                    Discover the world of digital art, NFTs are more than just
                    digital collectibles, they represent
                    <span class="text-myPurple-400 font-semibold uppercase"
                        >a new way of thinking about ownership.</span
                    >
                    Join the future now with NFTs.
                </p>
                <div class="flex items-center gap-x-6 mt-8">
                    <Link :href="route('login')"
                        class="text-lg rounded-full py-2 px-6 uppercase hover:bg-myPurple-300 bg-myPurple-400 transition-all"
                    >
                        Get Started
                </Link>
                    <Link :href="route('nfts/all')"
                        class="text-lg rounded-full py-2 px-6 border border-white bg-none hover:bg-white hover:text-black transition-all"
                    >
                        EXPLORE NFTs
            </Link>
                </div>
            </div>
            <div class="rounded-xl overflow-hidden">
                <img src="/storage/assets/hero2.png" alt="" class="w-full" />
            </div>
        </section>
    </main>
    <!-- collections -->
    <section
        class="mx-auto my-20 max-w-[1180px] bg-myDark-400 px-10 py-12 rounded-xl"
    >
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div
                    class="text-myPurple-400 text-base font-semibold uppercase"
                >
                    Gallery
                </div>
                <h3 class="text-4xl font-bold">Top Collections</h3>
            </div>
            <Link
                :href="route('/collections')"
                class="text-base rounded-full py-2 px-6 bg-myPurple-400 hover:bg-myPurple-300 transition-all"
            >
                View All
            </Link>
        </div>

        <div class="grid grid-cols-3 gap-x-4 gap-y-3">
            <div
                class="flex items-center gap-x-4 /border-b /border-myPurple-400 py-2 /px-4"
                v-for="col in cols"
                :key="col.symbol"
            >
                <div class="font-inter font-bold">
                    {{ cols.indexOf(col) + 1 }}
                </div>
                <div class="rounded-full overflow-hidden w-20 h-20">
                    <img
                        :src="col.image"
                        alt=""
                        class="min-w-full min-h-full"
                    />
                </div>
                <div class="flex flex-col">
                    <div
                        @click="showPopup(col)"
                        class="cursor-pointer font-inter font-semibold text-lg hover:text-myPurple-400 flex items-center gap-x-2"
                    >
                        {{ truncateString(16, col.name) }}
                        <span v-if="col.isBadged">
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
                    <div class="text-myGray text-sm font-semibold">
                        <span>{{ col.symbol }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Section -->
    <section class="mx-auto my-20 max-w-[1180px]" v-if="dropsCount !== 0">
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div
                    class="text-myPurple-400 text-base font-semibold uppercase"
                >
                    Drops
                </div>
                <h3 class="text-4xl font-bold">Most Unticipated</h3>
            </div>

            <Link
                :href="route('/nfts')"
                class="text-base rounded-full py-2 px-6 bg-myPurple-400 hover:bg-myPurple-300 transition-all"
            >
                View All
            </Link>
        </div>

        <NftSlider :drops="drops" :nftId="''" />
    </section>
    <!-- End Upcoming Section -->


    <!-- Table Section -->
    <section
        class="mx-auto my-20 max-w-[1180px] /bg-myDark-200 bg-[#0D0D0D] px-10 pt-12 pb-3 rounded-xl leading-relaxed"
    >
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div
                    class="text-myPurple-400 text-base font-semibold uppercase"
                >
                    NFTS
                </div>
                <h3 class="text-4xl font-bold">Featured Selection</h3>
            </div>

            <Link
                :href="route('nfts/all')"
                class="text-base rounded-full py-2 px-6 bg-myPurple-400 hover:bg-myPurple-300 transition-all"
            >
                View All
            </Link>
        </div>
        <table class="w-full">
            <thead class="border-b border-myDark-100 font-semibold">
                <tr class="">
                    <td class="py-3 //text-lg pl-3">#</td>
                    <td class="py-3 //text-lg">Name</td>
                    <td class="py-3 //text-lg">Social</td>
                    <td class="py-3 //text-lg">Blockchain</td>
                    <td class="py-3 //text-lg">supply</td>
                    <td class="py-3 //text-lg">Price</td>
                    <td class="py-3 //text-lg">Added</td>
                </tr>
            </thead>

            <tbody class="text-myGray font-semibold">
                <tr
                    v-for="item in nfts.data"
                    :key="item.id"
                    :class="[
                        nfts.data.indexOf(item) !== nfts.data.length - 1
                            ? 'border-b border-myDark-100'
                            : '',
                    ]"
                >
                    <td class="py-2 pl-3">{{ nfts.data.indexOf(item) + 1 }}</td>
                    <td class="py-2">
                        <Link
                            :href="route('nfts/nft')"
                            method="post"
                            as="button"
                            :data="{ id: item.id }"
                            class="w-fit flex gap-x-3 items-center hover:text-white"
                        >
                            <span class="rounded-full /overflow-hidden">
                                <img
                                    :src="item.imgurl"
                                    alt="testimonial"
                                    class="w-14 h-14 rounded-full flex-shrink-0 object-cover object-center"
                                />
                            </span>
                            <div class="flex items-center gap-x-2">
                                <span class="//font-semibold capitalize">{{
                                    item.name
                                }}</span>
                                <span v-if="item.is_featured">
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
                        </Link>
                    </td>
                    <td class="py-2">
                        <div class="flex items-center gap-x-3 text-2xl">
                            <span v-if="item.website">
                                <a
                                    :href="item.website"
                                    target="_blank"
                                    class="hover:text-white block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="ionicon"
                                        width="26px"
                                        height="26px"
                                        viewBox="0 0 512 512"
                                    >
                                        <title>Globe</title>
                                        <path
                                            d="M256 48C141.13 48 48 141.13 48 256s93.13 208 208 208 208-93.13 208-208S370.87 48 256 48z"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-miterlimit="10"
                                            stroke-width="32"
                                        />
                                        <path
                                            d="M256 48c-58.07 0-112.67 93.13-112.67 208S197.93 464 256 464s112.67-93.13 112.67-208S314.07 48 256 48z"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-miterlimit="10"
                                            stroke-width="32"
                                        />
                                        <path
                                            d="M117.33 117.33c38.24 27.15 86.38 43.34 138.67 43.34s100.43-16.19 138.67-43.34M394.67 394.67c-38.24-27.15-86.38-43.34-138.67-43.34s-100.43 16.19-138.67 43.34"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="32"
                                        />
                                        <path
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-miterlimit="10"
                                            stroke-width="32"
                                            d="M256 48v416M464 256H48"
                                        />
                                    </svg>
                                </a>
                            </span>
                            <span v-if="item.twitter">
                                <a
                                    :href="item.twitter"
                                    target="_blank"
                                    class="hover:text-white font-sm block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 30 30"
                                        width="28px"
                                        height="28px"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z"
                                        />
                                    </svg>
                                </a>
                            </span>
                            <span v-if="item.discord">
                                <a
                                    :href="item.discord"
                                    target="_blank"
                                    class="hover:text-white block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 72 72"
                                        width="28px"
                                        height="28px"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M54.657,19.077c0,0,8.343,9.663,8.343,27.069v3.65c0,0-10.536,6.866-13.747,6.866l-3.115-4.529	c1.936-0.867,4.577-2.372,4.577-2.372l-0.965-0.747c0,0-6.173,2.86-13.749,2.86s-13.749-2.86-13.749-2.86l-0.965,0.747	c0,0,2.641,1.505,4.577,2.372l-3.115,4.529C19.536,56.662,9,49.796,9,49.796v-3.65c0-17.406,8.343-27.069,8.343-27.069	s5.707-2.762,10.977-3.489l1.635,3.1c0,0,2.599-0.602,6.045-0.602s6.045,0.602,6.045,0.602l1.635-3.1	C48.95,16.315,54.657,19.077,54.657,19.077z M27.01,43.603c2.656,0,4.808-2.418,4.808-5.401c0-2.983-2.153-5.401-4.808-5.401	s-4.808,2.418-4.808,5.401C22.202,41.185,24.354,43.603,27.01,43.603z M44.99,43.603c2.656,0,4.808-2.418,4.808-5.401	c0-2.983-2.153-5.401-4.808-5.401c-2.656,0-4.808,2.418-4.808,5.401C40.182,41.185,42.334,43.603,44.99,43.603z"
                                        />
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </td>
                    <td class="py-2 capitalize">{{ item.blockchain }}</td>
                    <td class="py-2">{{ item.supply }}</td>
                    <td class="py-2 uppercase">
                        {{ item.price }} {{ item.blockchain.substr(0, 3) }}
                    </td>
                    <td class="py-2">{{ dateConvert(item.added).date }}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <!-- <pagination :links="nfts.links" /> -->
        </div>
    </section>
    <!-- End Table Section -->

    <!-- Blog Section -->
    <section
        class="mx-auto my-20 max-w-[1180px] bg-myDark-400 px-10 py-10 rounded-xl"
    >
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div
                    class="text-myPurple-400 text-base font-semibold uppercase"
                >
                    Blog
                </div>
                <h3 class="text-4xl font-bold">Latest News</h3>
            </div>
            <Link
                :href="route('blog')"
                class="text-base rounded-full py-2 px-6 bg-myPurple-400 hover:bg-myPurple-300 transition-all"
            >
                View All
            </Link>
        </div>
        <div class="grid grid-cols-3 gap-10 mt-4">
        <div v-for="item in posts" :key="item.id">
            <PostCard :item="item" />
        </div>
    </div>
    </section>
    <!-- End Blog Section -->

    <!-- News Letter -->
    <section class="mx-auto my-20 max-w-[1180px] rounded-xl newsletter-sec">
        <div class="/grid /grid-cols-2 py-16 px-10 /gap-x-4">
            <div class="text-center">
                <div class="flex flex-col">
                    <!-- <div
                        class="py-1 px-3 text-xs rounded-full news-letter-sub /bg-slate-400 w-fit mb-2"
                    >
                        News-letter
                    </div> -->
                    <h3 class="text-5xl font-inter font-black mb-3">
                        Join The Future Now
                    </h3>
                </div>
                <p class="max-w-[50%] mx-auto mb-4">
                    Don't miss out on the latest news, tips and insights from
                    our experts. Sign up for our newsletter today and stay ahead
                    of the curve.
                </p>
                <form
                    action="post"
                    class="flex items-center gap-x-3 mt-6 w-[50%] mx-auto"
                >
                    <div class="grow">
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email Adress"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <PrimaryButton
                        class="w-fit justify-center px-6"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Subscribe
                    </PrimaryButton>
                </form>
            </div>
            <div class="overflow-hidden">
                <!-- <div style="background:url('../../../storage/app/public/assets/eth.jpg')" class="h-[300px]">
                </div> -->
                <!-- <img src="storage/assets/nft.svg" alt="" class="scale-150"> -->
            </div>
        </div>
    </section>
    <!-- End News Letter -->

    <div
        class="bg-myDark-300/80 fixed top-0 left-0 w-full h-screen flex items-center z-10 hidden"
        id="confirmDelete"
        @click.self="close('')"
    >
        <div
            class="bg-myDark-100 overflow-hidden shadow-sm sm:rounded-lg px-10 py-10 w-[45%] mx-auto /////////translate-y-[130%]"
        >
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-2xl font-semibold">Delete NFT</h3>
                <button class="p-2 bg-gray-200 rounded-full" @click="close('')">
                    <span class="w-6">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            fill="#000000"
                            viewBox="0 0 256 256"
                        >
                            <rect width="256" height="256" fill="none"></rect>
                            <line
                                x1="200"
                                y1="56"
                                x2="56"
                                y2="200"
                                fill="none"
                                stroke="#000000"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="12"
                            ></line>
                            <line
                                x1="200"
                                y1="200"
                                x2="56"
                                y2="56"
                                fill="none"
                                stroke="#000000"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="12"
                            ></line>
                        </svg>
                    </span>
                </button>
            </div>
            <p>
                Are You sure you want to delete this NFT? This can't be undone!
            </p>
            <div class="flex items-center justify-between mt-6 gap-x-5">
                <PrimaryButton
                    type="button"
                    class="grow w-full justify-center"
                    @click="close('')"
                >
                    Cancel
                </PrimaryButton>

                <Link
                    :href="route('nfts/destroy')"
                    method="post"
                    as="button"
                    :data="{ id: nftId }"
                    @click="close('')"
                    class="w-full justify-center items-center px-4 py-3 bg-white border border-transparent rounded-full font-semibold text-black uppercase tracking-widest hover:bg-white/90 focus:bg-white/90 active:bg-white/90 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-sm"
                >
                    Delete
                </Link>
            </div>
        </div>
    </div>
    <Footer />
</template>

<style>
.newsletter-sec {
    background-color: #000000;
    background-image: radial-gradient(
            at 76% 60%,
            hsla(267, 94%, 59%, 1) 0,
            hsla(267, 94%, 59%, 0) 50%
        ),
        radial-gradient(
            at 42% 45%,
            hsla(239, 91%, 66%, 1) 0,
            hsla(239, 91%, 66%, 0) 50%
        ),
        radial-gradient(
            at 64% 38%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0.1) 50%
        ),
        radial-gradient(
            at 10% 32%,
            hsla(178, 91%, 75%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%
        ),
        radial-gradient(
            at 30% 85%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0.2) 50%
        ),
        radial-gradient(
            at 42% 89%,
            hsla(221, 90%, 52%, 1) 0,
            hsla(221, 90%, 52%, 0.3) 50%
        ),
        radial-gradient(
            at 100% 70%,
            hsla(178, 91%, 75%, 1) 0,
            hsla(178, 91%, 75%, 0.6) 50%
        ),
        radial-gradient(
            at 100% 10%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%
        );
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
