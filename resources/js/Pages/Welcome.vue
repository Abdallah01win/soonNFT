<script setup>
import { onMounted } from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Dialog from "@/Components/Dialog.vue";
import { Network, Alchemy } from "alchemy-sdk";
import Footer from "@/Components/Footer.vue";
import Navigation from "@/Components/Navigation.vue";
import NftSlider from "@/Components/NftSlider.vue"
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
        };
    },
    props: {
        nfts: Object,
        cols: Object,
        drops: Object,
        dropsCount: Number,
    },
    components: {
        Footer,
        Navigation,
        PrimaryButton,
        PrimaryButton,
        //Pagination,
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
        }
    },
};
</script>

<template>

    <Head title="Home" />

    <main class="main">
        <Navigation />
        <section class="grid grid-cols-2 gap-x-10 /h-[100vh] max-h-[620px] mx-auto max-w-[1180px] py-10">
            <div class="flex flex-col justify-center">
                <h1 class="font-inter font-black text-6xl mb-3 uppercase">
                    Unlocking a New Dimension of <span class="text-myPurple-400">NFT Collection</span>
                </h1>
                <p class="text-myGray text-lg leading-relaxed">
                    Discover the world of digital art, NFTs are more than just digital collectibles, they represent
                    <span class="text-myPurple-400 font-semibold uppercase">a new way of thinking about
                        ownership.</span> Join the future now with NFTs.
                </p>
                <div class="flex items-center gap-x-6 mt-8">
                    <button class="text-lg rounded-full py-2 px-6 uppercase /border /border-white bg-myPurple-400">
                        Get Started
                    </button>
                    <button class="text-lg rounded-full py-2 px-6 border border-white bg-none">
                        EXPLORE NFTs
                    </button>
                </div>
            </div>
            <div class="rounded-xl overflow-hidden">
                <img src="/storage/assets/hero2.png" alt="" class="w-full">
            </div>
        </section>
    </main>
    <!-- collections -->
    <section class="mx-auto my-20 max-w-[1180px] bg-[#0D0D0D] px-10 py-12 rounded-xl">
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div class="text-myPurple-400 text-base font-semibold uppercase">Gallery</div>
                <h3 class="text-4xl font-bold">Top Collections</h3>
            </div>
            <Link :href="route('/nfts')" class="text-base rounded-full py-2 px-6 bg-myPurple-400 transition-all">
            View All
            </Link>
        </div>

        <div class="grid grid-cols-3 gap-x-4 gap-y-3">
            <div class="flex items-center gap-x-4  /border-b /border-myPurple-400 py-2 /px-4" v-for="col in cols"
                :key="col.symbol">
                <div class="font-inter font-bold">{{ cols.indexOf(col) + 1 }}</div>
                <div class="rounded-full overflow-hidden w-20 h-20">
                    <img :src="col.image" alt="">
                </div>
                <div class="flex flex-col justify">
                    <Link :href="route('/collection')" :data="{ id: col.symbol }" method="post" as="button"
                        class="font-inter font-semibold text-lg hover:text-myPurple-400 flex items-center gap-x-2">{{
                            truncateString(16, col.name) 
                        }} <span v-if="col.isBadged">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#5e45ff" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <path
                                d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z">
                            </path>
                        </svg>
                    </span>
                    </Link>
                    <div class="text-myGray text-sm font-semibold">Floor: <span>0.001</span></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="mx-auto my-20 max-w-[1180px]" v-if="dropsCount !== 0">
        <div class="flex items-center justify-between">

            <div class="flex flex-col mb-6">
                <div class="text-myPurple-400 text-base font-semibold uppercase">Drops</div>
                <h3 class="text-4xl font-bold">Most Unticipated</h3>
            </div>

            <Link v-if="dropsCount > 8" :href="route('/nfts')" class="text-base rounded-full py-2 px-6 bg-myPurple-400 transition-all">
            View All
            </Link>
        </div>

        <NftSlider :drops="drops" :nftId="''" />
    </section>
    <!-- End Gallery Section -->

    <!-- Blog Section -->
    <!-- <section class="mx-auto my-20 max-w-[1180px]">
        <div class="flex flex-col mb-6">
            <div class="text-white opacity-50 text-lg">Blog</div>
            <h3 class="text-4xl font-bold">Recent posts</h3>
        </div>
    </section> -->
    <!-- End Blog Section -->

    <!-- Text Section -->

    <!-- <section class="mx-auto my-20 max-w-[1180px] bg-myDark-200 px-10 py-12 rounded-xl">
        <div class="grid grid-cols-2 gap-10">
            <div class="rounded-xl overflow-hidden min-h-[300px]" style="background:url('/storage/assets/eth.jpg') no-repeat center center;">
            </div>
            <div>
                
                <h3 class="font-inter font-bold text-5xl mb-3">Some big Title</h3>
                <p class="text-myGray leading-6 mb-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem eos nam iste sit perspiciatis error officiis repellat facere. Fugit pariatur dolore saepe nam dolorum at porro nostrum reprehenderit! Eos, facilis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quidem.</p>
                <button class="bg-transparent border border-white rounded-full py-2 px-8 hover:bg-white hover:text-black">
                    Explore Now
                </button>
                
            </div>
        </div>

    </section> -->

    <!-- End Text Section -->

    <!-- Table Section -->
    <section class="mx-auto my-20 max-w-[1180px] /bg-myDark-200 bg-[#0D0D0D] px-10 pt-12 pb-3 rounded-xl leading-relaxed">
        <div class="flex flex-col mb-6">
            <div class="text-myPurple-400 text-base font-semibold uppercase">NFTs</div>
            <h3 class="text-4xl font-bold">Featured Selection</h3>
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
                    <td class="py-3 //text-lg">Drop</td>
                    <td class="py-3 //text-lg" v-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.type === 1
                    ">
                        Actions
                    </td>
                </tr>
            </thead>

            <tbody class="text-myGray font-semibold">
                <tr v-for="item in nfts.data" :key="item.id" :class="[nfts.data.indexOf(item) !== nfts.data.length - 1 ? 'border-b border-myDark-100' : '']">
                    <td class="py-2 pl-3">{{ nfts.data.indexOf(item) + 1 }}</td>
                    <td class="py-2">
                        <Link :href="route('nfts/nft')" method="post" as="button" :data="{ id: item.id }"
                            class="w-fit flex gap-x-3 items-center hover:text-white">
                        <span class="rounded-full /overflow-hidden">
                            <img :src="item.imgurl" alt="testimonial"
                                class="w-14 h-14 rounded-full flex-shrink-0 object-cover object-center" />
                        </span>
                        <span class="//font-semibold capitalize">{{
                            item.name
                        }}</span>
                        </Link>
                    </td>
                    <td class="py-2">
                        <div class="flex items-center gap-x-3 text-2xl">
                            <span v-if="item.website">
                                <a :href="item.website" target="_blank" class="hover:text-white block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="26px" height="26px" viewBox="0 0 512 512"><title>Globe</title><path d="M256 48C141.13 48 48 141.13 48 256s93.13 208 208 208 208-93.13 208-208S370.87 48 256 48z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M256 48c-58.07 0-112.67 93.13-112.67 208S197.93 464 256 464s112.67-93.13 112.67-208S314.07 48 256 48z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M117.33 117.33c38.24 27.15 86.38 43.34 138.67 43.34s100.43-16.19 138.67-43.34M394.67 394.67c-38.24-27.15-86.38-43.34-138.67-43.34s-100.43 16.19-138.67 43.34" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M256 48v416M464 256H48"/></svg>
                                </a>
                            </span>
                            <span v-if="item.twitter">
                                <a :href="item.twitter" target="_blank" class="hover:text-white font-sm block">
                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="28px" height="28px" fill="currentColor">    <path d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z"/></svg>
                                </a>
                            </span>
                            <span v-if="item.discord">
                                <a :href="item.discord" target="_blank" class="hover:text-white block">
                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 72 72" width="28px" height="28px" fill="currentColor"><path d="M54.657,19.077c0,0,8.343,9.663,8.343,27.069v3.65c0,0-10.536,6.866-13.747,6.866l-3.115-4.529	c1.936-0.867,4.577-2.372,4.577-2.372l-0.965-0.747c0,0-6.173,2.86-13.749,2.86s-13.749-2.86-13.749-2.86l-0.965,0.747	c0,0,2.641,1.505,4.577,2.372l-3.115,4.529C19.536,56.662,9,49.796,9,49.796v-3.65c0-17.406,8.343-27.069,8.343-27.069	s5.707-2.762,10.977-3.489l1.635,3.1c0,0,2.599-0.602,6.045-0.602s6.045,0.602,6.045,0.602l1.635-3.1	C48.95,16.315,54.657,19.077,54.657,19.077z M27.01,43.603c2.656,0,4.808-2.418,4.808-5.401c0-2.983-2.153-5.401-4.808-5.401	s-4.808,2.418-4.808,5.401C22.202,41.185,24.354,43.603,27.01,43.603z M44.99,43.603c2.656,0,4.808-2.418,4.808-5.401	c0-2.983-2.153-5.401-4.808-5.401c-2.656,0-4.808,2.418-4.808,5.401C40.182,41.185,42.334,43.603,44.99,43.603z"/></svg>
                                </a>
                            </span>
                        </div>
                    </td>
                    <td class="py-2 capitalize">{{ item.blockchain }}</td>
                    <td class="py-2">{{ item.supply }}</td>
                    <td class="py-2 uppercase">
                        {{ item.price }} {{ item.blockchain.substr(0, 3) }}
                    </td>
                    <td class="py-2">{{ dateConvert(item.dropdate).date }}</td>
                    <td class="py-2" v-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.type === 1
                    ">
                        <div class="flex items-center gap-x-3 text-2xl">
                            <span>
                                <div class="hover:text-white cursor-pointer" @click="close(item.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor"
                                        viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none"></rect>
                                        <line x1="216" y1="56" x2="40" y2="56" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line>
                                        <line x1="104" y1="104" x2="104" y2="168" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line>
                                        <line x1="152" y1="104" x2="152" y2="168" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line>
                                        <path d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="8"></path>
                                        <path d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56" fill="none"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="8"></path>
                                    </svg>
                                </div>
                            </span>
                            <span>
                                <Link class="cursor-pointer block" :href="route('/')" method="post" as="button"
                                    :data="{ id: item.id }">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <rect width="256" height="256" fill="none"></rect>
                                    <path
                                        d="M96,216H48a8,8,0,0,1-8-8V163.3a7.9,7.9,0,0,1,2.3-5.6l120-120a8,8,0,0,1,11.4,0l44.6,44.6a8,8,0,0,1,0,11.4Z"
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="8"></path>
                                    <line x1="136" y1="64" x2="192" y2="120" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line>
                                    <polyline points="216 216 96 216 40.5 160.5" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></polyline>
                                    <line x1="164" y1="92" x2="68" y2="188" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line>
                                </svg>
                                </Link>
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <!-- <pagination :links="nfts.links" /> -->
        </div>
    </section>
    <!-- End Table Section -->
    <!-- News Letter -->

    <section class="mx-auto my-20 max-w-[1180px] rounded-xl newsletter-sec">
        <div class="grid grid-cols-2 py-16 px-10 gap-x-4">
            <div class="text">
                <div class="flex flex-col">
                    <div class="py-1 px-3 text-xs rounded-full news-letter-sub /bg-slate-400 w-fit mb-2">
                        News-letter
                    </div>
                    <h3 class="text-5xl font-inter font-black mb-3">
                        Join The Future Now
                    </h3>
                </div>
                <p class="/max-w-[80%] mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Veniam magnam officia sequi debitis necessitatibus
                    asperiores.
                </p>
                <form action="post" class="flex items-center gap-x-3 mt-6">
                    <div class="grow">
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" placeholder="Email Adress" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <PrimaryButton class="w-fit justify-center px-6" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
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

    <div class="bg-myDark-300/80 fixed top-0 left-0 w-full h-screen flex items-center z-10 hidden" id="confirmDelete"
        @click.self="close('')">
        <div
            class="bg-myDark-100 overflow-hidden shadow-sm sm:rounded-lg px-10 py-10 w-[45%] mx-auto /////////translate-y-[130%]">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-2xl font-semibold">Delete NFT</h3>
                <button class="p-2 bg-gray-200 rounded-full" @click="close('')">
                    <span class="w-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#000000" viewBox="0 0 256 256">
                            <rect width="256" height="256" fill="none"></rect>
                            <line x1="200" y1="56" x2="56" y2="200" fill="none" stroke="#000000" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="12"></line>
                            <line x1="200" y1="200" x2="56" y2="56" fill="none" stroke="#000000" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="12"></line>
                        </svg>
                    </span>
                </button>
            </div>
            <p>
                Are You sure you want to delete this NFT? This can't be undone!
            </p>
            <div class="flex items-center justify-between mt-6 gap-x-5">
                <PrimaryButton type="button" class="grow w-full justify-center" @click="close('')">
                    Cancel
                </PrimaryButton>

                <Link :href="route('nfts/destroy')" method="post" as="button" :data="{ id: nftId }" @click="close('')"
                    class="w-full justify-center items-center px-4 py-3 bg-white border border-transparent rounded-full font-semibold text-black uppercase tracking-widest hover:bg-white/90 focus:bg-white/90 active:bg-white/90 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-sm">
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
    background-image: radial-gradient(at 76% 60%,
            hsla(267, 94%, 59%, 1) 0,
            hsla(267, 94%, 59%, 0) 50%),
        radial-gradient(at 42% 45%,
            hsla(239, 91%, 66%, 1) 0,
            hsla(239, 91%, 66%, 0) 50%),
        radial-gradient(at 64% 38%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%),
        radial-gradient(at 10% 32%,
            hsla(313, 85%, 61%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%),
        radial-gradient(at 30% 85%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%),
        radial-gradient(at 42% 89%,
            hsla(221, 90%, 52%, 1) 0,
            hsla(221, 90%, 52%, 0) 50%),
        radial-gradient(at 100% 70%,
            hsla(313, 85%, 61%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%),
        radial-gradient(at 100% 10%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%);
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
