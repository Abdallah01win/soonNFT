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
    },
};
</script>

<template>
    <Head title="Home" />

    <main class="main">
        <Navigation />
        <section
            class="flex items-center h-[100vh] max-h-[620px] mx-auto max-w-[1180px]"
        >
            <div class="flex flex-col items-center /translate-y-[-50%]">
                <h1 class="font-inter font-black text-6xl mb-3 uppercase">
                    The NFT World in your hands
                </h1>
                <p class="text-center max-w-[70%] mx-auto">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Porro quae velit modi voluptatem, iure explicabo! Lorem
                    ipsum dolor sit, amet consectetur adipisicing elit.
                </p>
                <div class="flex items-center gap-x-6 mt-8">
                    <button
                        class="text-lg rounded-full py-2 px-6 uppercase border border-white bg-none"
                    >
                        Get Started
                    </button>
                    <button
                        class="text-lg rounded-full py-2 px-6 border border-white bg-none"
                    >
                        EXPLORE NFTs
                    </button>
                </div>
            </div>
        </section>
    </main>
    <!-- Gallery Section -->
    <section class="mx-auto my-20 max-w-[1180px]">
            <div class="flex items-center justify-between">

                <div class="flex flex-col mb-6">
                    <div class="text-myGray text-lg">Gallery</div>
                    <h3 class="text-4xl font-bold">Trending NFTs</h3>
                </div>

                <Link class="hover:underline underline-offset-4 font-semibold">
                View All
                </Link>
            </div>
       
        <NftSlider :dataRoute="'nfts/list'" :nftId="''"/>
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

    <section class="mx-auto my-20 max-w-[1180px] bg-myDark-200 px-10 py-12 rounded-xl">
        <div class="grid grid-cols-2 gap-10">
            <div class="rounded-xl overflow-hidden min-h-[300px]" style="background:url('/storage/assets/eth.jpg') no-repeat center center;">
                <!-- Image -->
                <!-- <img src="/storage/assets/eth.jpg" alt="ethereum" class=""> -->
            </div>
            <div>
                <!-- text -->
                <h3 class="font-inter font-bold text-5xl mb-3">Some big Title</h3>
                <p class="text-myGray leading-6 mb-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem eos nam iste sit perspiciatis error officiis repellat facere. Fugit pariatur dolore saepe nam dolorum at porro nostrum reprehenderit! Eos, facilis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quidem.</p>
                <button class="bg-transparent border border-white rounded-full py-2 px-8 hover:bg-white hover:text-black">
                    Explore Now
                </button>
                
            </div>
        </div>

    </section>

    <!-- End Text Section -->

    <!-- Table Section -->
    <section
        class="mx-auto my-20 max-w-[1180px] bg-myDark-200 px-10 py-12 rounded-xl"
    >
        <div class="flex flex-col mb-6">
            <div class="text-myGray text-lg">Gallery</div>
            <h3 class="text-4xl font-bold">Popular NFTs</h3>
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
                    <td
                        class="py-3 //text-lg"
                        v-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.type === 1
                        "
                    >
                        Actions
                    </td>
                </tr>
            </thead>

            <tbody class="text-myGray">
                <tr
                    v-for="item in nfts.data"
                    :key="item.id"
                    class="border-b border-myDark-100"
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
                            <span class="//font-semibold capitalize">{{
                                item.name
                            }}</span>
                        </Link>
                    </td>
                    <td class="py-2">
                        <div class="flex items-center gap-x-3 text-2xl">
                            <span v-if="item.website">
                                <a
                                    :href="item.website"
                                    target="_blank"
                                    class="hover:text-white w-6 block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="26"
                                        fill="currentColor"
                                        viewBox="0 0 256 256"
                                    >
                                        <rect
                                            width="256"
                                            height="256"
                                            fill="none"
                                        ></rect>
                                        <circle
                                            cx="128"
                                            cy="128"
                                            r="96"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></circle>
                                        <line
                                            x1="37.5"
                                            y1="96"
                                            x2="218.5"
                                            y2="96"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
                                        <line
                                            x1="37.5"
                                            y1="160"
                                            x2="218.5"
                                            y2="160"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
                                        <ellipse
                                            cx="128"
                                            cy="128"
                                            rx="40"
                                            ry="93.4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></ellipse>
                                    </svg>
                                </a>
                            </span>
                            <span v-if="item.twitter">
                                <a
                                    :href="item.twitter"
                                    target="_blank"
                                    class="hover:text-white w-6 block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="26"
                                        fill="currentColor"
                                        viewBox="0 0 256 256"
                                    >
                                        <rect
                                            width="256"
                                            height="256"
                                            fill="none"
                                        ></rect>
                                        <path
                                            d="M128,88c0-22,18.5-40.3,40.5-40a40,40,0,0,1,36.2,24H240l-32.3,32.3A127.9,127.9,0,0,1,80,224c-32,0-40-12-40-12s32-12,48-36c0,0-64-32-48-120,0,0,40,40,88,48Z"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                    </svg>
                                </a>
                            </span>
                            <span v-if="item.discord">
                                <a
                                    :href="item.discord"
                                    target="_blank"
                                    class="hover:text-white w-6 block"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="26"
                                        fill="currentColor"
                                        viewBox="0 0 256 256"
                                    >
                                        <rect
                                            width="256"
                                            height="256"
                                            fill="none"
                                        ></rect>
                                        <circle cx="96" cy="144" r="8"></circle>
                                        <circle
                                            cx="160"
                                            cy="144"
                                            r="8"
                                        ></circle>
                                        <path
                                            d="M74.4,80A174.9,174.9,0,0,1,128,72a174.9,174.9,0,0,1,53.6,8"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                        <path
                                            d="M181.6,176a174.9,174.9,0,0,1-53.6,8,174.9,174.9,0,0,1-53.6-8"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                        <path
                                            d="M155,182.1l12.1,24a7.8,7.8,0,0,0,9,4.2c24.5-6,45.7-16.4,61.1-29.8a8.1,8.1,0,0,0,2.4-8.4L205.7,58.9a7.7,7.7,0,0,0-4.7-5.1,176.4,176.4,0,0,0-29.6-9.2,8.1,8.1,0,0,0-9.4,5.3l-7.9,23.9"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                        <path
                                            d="M101,182.1l-12.1,24a7.8,7.8,0,0,1-9,4.2c-24.5-6-45.7-16.4-61.1-29.8a8.1,8.1,0,0,1-2.4-8.4L50.3,58.9A7.7,7.7,0,0,1,55,53.8a176.4,176.4,0,0,1,29.6-9.2A8.1,8.1,0,0,1,94,49.9l7.9,23.9"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
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
                    <td class="py-2">{{ dateConvert(item.dropdate).date }}</td>
                    <td
                        class="py-2"
                        v-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.type === 1
                        "
                    >
                        <div class="flex items-center gap-x-3 text-2xl">
                            <span>
                                <div
                                    class="hover:text-white cursor-pointer"
                                    @click="close(item.id)"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="26"
                                        fill="currentColor"
                                        viewBox="0 0 256 256"
                                    >
                                        <rect
                                            width="256"
                                            height="256"
                                            fill="none"
                                        ></rect>
                                        <line
                                            x1="216"
                                            y1="56"
                                            x2="40"
                                            y2="56"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
                                        <line
                                            x1="104"
                                            y1="104"
                                            x2="104"
                                            y2="168"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
                                        <line
                                            x1="152"
                                            y1="104"
                                            x2="152"
                                            y2="168"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
                                        <path
                                            d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                        <path
                                            d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                    </svg>
                                </div>
                            </span>
                            <span>
                                <Link
                                    class="cursor-pointer block"
                                    :href="route('/')"
                                    method="post"
                                    as="button"
                                    :data="{ id: item.id }"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="26"
                                        fill="currentColor"
                                        viewBox="0 0 256 256"
                                    >
                                        <rect
                                            width="256"
                                            height="256"
                                            fill="none"
                                        ></rect>
                                        <path
                                            d="M96,216H48a8,8,0,0,1-8-8V163.3a7.9,7.9,0,0,1,2.3-5.6l120-120a8,8,0,0,1,11.4,0l44.6,44.6a8,8,0,0,1,0,11.4Z"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></path>
                                        <line
                                            x1="136"
                                            y1="64"
                                            x2="192"
                                            y2="120"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
                                        <polyline
                                            points="216 216 96 216 40.5 160.5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></polyline>
                                        <line
                                            x1="164"
                                            y1="92"
                                            x2="68"
                                            y2="188"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="8"
                                        ></line>
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
                    <div
                        class="py-1 px-3 text-xs rounded-full news-letter-sub /bg-slate-400 w-fit mb-2"
                    >
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
            <div class="rounded-2xl overflow-hidden">
                <!-- <div style="background:url('../../../storage/app/public/assets/eth.jpg')" class="h-[300px]">
                </div> -->
                <!-- <img src="../../../storage/app/public/assets/eth.jpg" alt="" class=" w-full"> -->
            </div>
        </div>
    </section>

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
                    >Delete
                </Link>
            </div>
        </div>
    </div>
    <Footer />
</template>

<style>
.main {
    background-color: #0a0a0aff;
    background-image: radial-gradient(
            at 76% 58%,
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
            hsla(267, 85%, 50%, 0) 50%
        ),
        radial-gradient(
            at 2% 32%,
            hsla(313, 85%, 61%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%
        ),
        radial-gradient(
            at 26% 55%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%
        ),
        radial-gradient(
            at 42% 59%,
            hsla(221, 90%, 52%, 1) 0,
            hsla(221, 90%, 52%, 0) 50%
        );
}

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
            hsla(267, 85%, 50%, 0) 50%
        ),
        radial-gradient(
            at 10% 32%,
            hsla(313, 85%, 61%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%
        ),
        radial-gradient(
            at 30% 85%,
            hsla(267, 85%, 50%, 1) 0,
            hsla(267, 85%, 50%, 0) 50%
        ),
        radial-gradient(
            at 42% 89%,
            hsla(221, 90%, 52%, 1) 0,
            hsla(221, 90%, 52%, 0) 50%
        ),
        radial-gradient(
            at 100% 70%,
            hsla(313, 85%, 61%, 1) 0,
            hsla(313, 85%, 61%, 0) 50%
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
.nft-card:hover .nft-card-chain{
    display: grid !important;
}

.news-letter-sub {
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(50px);
    -webkit-backdrop-filter: blur(50px);
}

.splide__pagination{
    display: none !important;
}
</style>
