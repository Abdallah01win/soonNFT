<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Navigation from "@/Components/Navigation.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NftSlider from "@/Components/NftSlider.vue";
import Footer from "@/Components/Footer.vue";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import "@splidejs/vue-splide/css";
</script>
<script>
export default {
    props: {
        nft: Object,
        nfts: Array,
        screen: window.screen.width,
    },
    components: {
        Splide,
        SplideSlide,
        Head,
        Navigation,
        PrimaryButton,
        NftSlider,
        Footer,
        Link,
    },
    computed: {
        width() {
            return this.screen >= 768 ? 2 : 1;
        },
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },
        close() {
            const confirmDelete = document.getElementById("confirmDelete");
            const body = document.body;
            body.classList.toggle("overflow-hidden");
            confirmDelete.classList.toggle("hidden");
        },
        truncateString(num, str) {
            if (str.length > num) {
                return str.substring(0, num) + "...";
            } else {
                return str;
            }
        },
    },
};
</script>

<template>
    <Head :title="nft.name" />
    <AuthenticatedLayout class="bg-myDark-300">
        <template v-slot:nav>
            <Navigation class="" />
        </template>
        <section class="mx-auto my-6 sm:my-10 md:my-12 max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px] max-sm:px-[8%] py-6 md:py-10 lg:py-12 ">
            <div class="grid grid-cols-1 lg:grid-cols-[.45fr,1fr] gap-y-6 md:gap-y-8 lg:gap-x-10 xl:gap-x-12">
                <div
                    class="rounded-xl overflow-hidden w-[100%] h-[350px] relative"
                >
                    <img :src="nft.imgurl" alt="" class="w-[100%] h-[100%]" />
                    <div
                        v-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.type === 1
                        "
                        @click="close"
                        class="absolute top-0 left-0 mt-4 ml-4 rounded-full bg-slate-300 py-2 px-2 cursor-pointer"
                    >
                        <span class="">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                fill="#000000"
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
                                    stroke="#000000"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="12"
                                ></line>
                                <line
                                    x1="104"
                                    y1="104"
                                    x2="104"
                                    y2="168"
                                    fill="none"
                                    stroke="#000000"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="12"
                                ></line>
                                <line
                                    x1="152"
                                    y1="104"
                                    x2="152"
                                    y2="168"
                                    fill="none"
                                    stroke="#000000"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="12"
                                ></line>
                                <path
                                    d="M200,56V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56"
                                    fill="none"
                                    stroke="#000000"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="12"
                                ></path>
                                <path
                                    d="M168,56V40a16,16,0,0,0-16-16H104A16,16,0,0,0,88,40V56"
                                    fill="none"
                                    stroke="#000000"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="12"
                                ></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="font-bold mb-3 flex flex-col">
                        <div
                            class="text-xs uppercase px-3 md:px-4 py-1 mb-2 rounded-full bg-myPurple-400 w-fit"
                        >
                            {{ nft.blockchain }}
                        </div>
                        <div
                            class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-inter capitalize flex gap-x-2"
                        >
                            <span>
                                {{ nft.name }}
                            </span>
                            <span v-if="nft.is_featured">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20px"
                                    height="20px"
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
                    </div>
                    <p class="mb-6 text-myGray">
                        {{ nft.discription }}
                    </p>
                    <div class="flex items-end justify-between">
                        <div
                            class="flex flex-col gap-y-1"
                        >
                            <div class="text-xs md:text-base font-semibold uppercase">
                                Price
                            </div>
                            <div class="font-bold text-2xl md:text-3xl lg:text-4xl uppercase">
                                {{ nft.price }}
                                {{ nft.blockchain.substring(0, 3) }}
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-x-3 text-2xl">
                                <span v-if="nft.website">
                                    <a
                                        :href="nft.website"
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
                                <span v-if="nft.twitter">
                                    <a
                                        :href="nft.twitter"
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
                                <span v-if="nft.discord">
                                    <a
                                        :href="nft.discord"
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Suggested Section -->
        <section
            class="mx-auto my-10 sm:my-14 md:my-18 max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px]"
        >
            <div class="flex items-end justify-between mb-6 max-sm:px-[8%]">
                <div class="flex flex-col">
                    <div
                        class="text-myPurple-400 text-sm xl:text-base font-semibold uppercase"
                    >
                        NFTS
                    </div>
                    <h3
                        class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold"
                    >
                        Suggested NFTs
                    </h3>
                </div>
                <Link
                    :href="route('nfts/all')"
                    class="text-xs sm:text-sm lg:text-base rounded-full py-1 px-3 sm:px-4 lg:py-2 lg:px-6 bg-myPurple-400 hover:bg-myPurple-300 transition-all"
                >
                    View All
                </Link>
            </div>

            <Splide
                :options="{
                    rewind: true,
                    autoWidth: true,
                    focus: 'center',
                    perPage: 4,
                    perMove: width,
                    gap: '2em',
                    padding: '4rem',
                }"
                :classes="{
                    pagination: 'splide__pagination no-pagination',
                }"
                aria-label="Viral Nfts"
            >
                <SplideSlide v-for="item in nfts" :key="item.id">
                    <div
                        class="bg-[#0D0D0D] rounded-2xl relative overflow-hidden"
                    >
                        <div class="w-[255px] h-[255px]">
                            <img
                                :src="item.imgurl"
                                alt=""
                                class="min-w-[100%] h-full block rounded-2xl"
                            />
                        </div>
                        <div class="py-3 px-4">
                            <div class="pb-1">
                                <Link
                                    :href="route('nfts/nft')"
                                    method="post"
                                    as="button"
                                    :data="{ id: item.id }"
                                    class="flex items-center gap-x-2 capitalize hover:text-myPurple-400 font-inter font-semibold text-base cursor-pointer"
                                >
                                    {{ truncateString(19, item.name) }}
                                    <span v-if="item.is_featured">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16px"
                                            height="16px"
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
                                </Link>
                            </div>
                            <div
                                class="flex items-center justify-between font-semibold text-myGray /border-t /border-myGray pt-1"
                            >
                                <div
                                    v-if="item.price"
                                    class="text-sm uppercase"
                                >
                                    {{ item.price }}
                                    {{ item.blockchain.substring(0, 3) }}
                                </div>
                                <div v-else class="text-sm uppercase">--</div>
                                <div class="text-sm uppercase">
                                    {{ dateConvert(item.created_at).date }}
                                </div>
                            </div>
                        </div>
                    </div>
                </SplideSlide>
            </Splide>
        </section>

        <!-- Confirm Delete -->
        <div
            class="bg-myDark-300/80 fixed top-0 left-0 w-full h-screen flex items-center z-10 hidden"
            id="confirmDelete"
            @click.self="close"
        >
            <div
                class="bg-myDark-100 overflow-hidden shadow-sm sm:rounded-lg px-10 py-10 w-[45%] mx-auto /////////translate-y-[130%]"
            >
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-2xl font-semibold">Delete NFT</h3>
                    <button class="p-2 bg-gray-200 rounded-full" @click="close">
                        <span class="w-6">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                fill="#000000"
                                viewBox="0 0 256 256"
                            >
                                <rect
                                    width="256"
                                    height="256"
                                    fill="none"
                                ></rect>
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
                    Are You sure you want to delete this NFT? This can't be
                    undone!
                </p>
                <div class="flex items-center justify-between mt-6 gap-x-5">
                    <Link
                        :href="route('nfts/destroy')"
                        method="post"
                        as="button"
                        :data="{ id: nft.id }"
                        @click="close"
                        class="w-full justify-center items-center px-4 py-3 bg-white border border-transparent rounded-full font-semibold text-black uppercase tracking-widest hover:bg-white/90 focus:bg-white/90 active:bg-white/90 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-sm"
                    >
                        Delete
                    </Link>

                    <div
                        type="button"
                        class="grow flex cursor-pointer w-full justify-center px-4 py-3 rounded-full bg-transparent border border-white text-white/100"
                        @click="close"
                    >
                        Cancel
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </AuthenticatedLayout>
</template>
