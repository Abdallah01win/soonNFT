<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Navigation from "@/Components/Navigation.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Footer from "@/Components/Footer.vue";
</script>
<script>
export default {
    props: {
        nft: Object,
    },
    components: {
        Navigation,
        PrimaryButton,
        Footer,
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
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout class="bg-myDark-300">
        <template v-slot:nav>
            <Navigation class="" />
        </template>
        <section class="mx-auto my-12 max-w-[1180px]">
            <div class="grid grid-cols-[1fr,1.8fr] gap-x-12">
                <div class="rounded-xl overflow-hidden w-[100%] h-[400px]">
                    <img :src="nft.imgurl" alt="" class="w-[100%] h-[100%]" />
                </div>
                <div class="flex flex-col">
                    <div
                        class="font-bold mb-3 flex flex-col /items-center /justify-between"
                    >
                        <span
                            class="text-xs uppercase px-4 py-1 mb-2 rounded-full bg-myGray w-fit"
                        >
                            {{ nft.blockchain }}
                        </span>
                        <span class="text-6xl font-inter">
                            {{ nft.name }}
                        </span>
                    </div>
                    <!-- <p>{{ nft.description }}</p> -->
                    <p class="/lg:w-[85%] mb-6 text-myGray">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Veniam, inventore rem, expedita sapiente quas culpa
                        tempora nisi, labore iste repellendus beatae odio. Neque
                        eligendi harum ad beatae, odit nobis quo! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    </p>

                    <div class="grid grid-cols-2 uppercase mb-10">
                        <div
                            class="flex flex-col gap-y-3 border-r border-myGray"
                        >
                            <div class="text-base font-semibold">
                                Floor Price
                            </div>
                            <div class="font-bold text-4xl">
                                {{ nft.price }}
                                {{ nft.blockchain.substring(0, 3) }}
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-3 pl-12">
                            <div class="text-base font-semibold">Drop Date</div>
                            <div class="font-bold text-4xl">
                                {{ dateConvert(nft.dropdate).date }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-x-4">
                            <PrimaryButton class="flex items-center gap-y-3">
                                <span class="mr-2"> Add to Favorits </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M133.7,211.9l81-81c19.9-20,22.8-52.7,4-73.6a52,52,0,0,0-75.5-2.1L128,70.5,114.9,57.3c-20-19.9-52.7-22.8-73.6-4a52,52,0,0,0-2.1,75.5l83.1,83.1A8.1,8.1,0,0,0,133.7,211.9Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                                </span>
                                
                            </PrimaryButton>
                            <PrimaryButton
                                class="bg-transparent text-white/100 border border-white/100 hover:bg-white hover:text-black"
                            >
                                <span class="mr-2">Share</span>
                                <span class="w-[26px]">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="ionicon"
                                        viewBox="0 0 512 512"
                                    >
                                        <title>Arrow Redo</title>
                                        <path
                                            d="M448 256L272 88v96C103.57 184 64 304.77 64 424c48.61-62.24 91.6-96 208-96v96z"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linejoin="round"
                                            stroke-width="32"
                                        />
                                    </svg>
                                </span>
                            </PrimaryButton>
                        </div>
                        <div>
                            <div class="flex items-center gap-x-3 text-2xl">
                                <span v-if="nft.website" class="">
                                    <a
                                        :href="nft.website"
                                        target="_blank"
                                        class="bg-white rounded-full p-2 grid place-content-center text-black hover:bg-white/90"
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
                                <span v-if="nft.twitter" class="">
                                    <a
                                        :href="nft.twitter"
                                        target="_blank"
                                        class="bg-white rounded-full p-2 grid place-content-center text-black hover:bg-white/90"
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
                                <span v-if="nft.discord" class="">
                                    <a
                                        :href="nft.discord"
                                        target="_blank"
                                        class="bg-white rounded-full p-2 grid place-content-center text-black hover:bg-white/90"
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
                                                cx="96"
                                                cy="144"
                                                r="8"
                                            ></circle>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Footer />
    </AuthenticatedLayout>
</template>
