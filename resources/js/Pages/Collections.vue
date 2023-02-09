<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';
export default {
    data() {
        return {
            searchTerm: '',
            col: "",
        }
    },
    props: {
        cols: Object,
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

    <Head title="Home" />
    <Navigation />
    <section class="mx-auto my-12 max-w-[1180px] bg-myDark-400 px-10 py-12 rounded-xl">
        <div class="flex items-center justify-between">
            <div class="flex flex-col mb-6">
                <div class="text-myPurple-400 text-base font-semibold uppercase">
                    Gallery
                </div>
                <h3 class="text-4xl font-bold">All Collections</h3>
            </div>
            <input type="text" class="border-[3px] border-myPurple-400 focus:border-myPurple-400 focus:ring-0 rounded-full bg-transparent placeholder:text-myGray"
                placeholder="Search" v-model="searchTerm" @input="searchData" />
        </div>

        <div class="grid grid-cols-3 gap-x-4 gap-y-3">
            <p v-if="!filteredData.length" class="text-lg text-myGray">No Collections</p>
            <div v-else class="flex items-center gap-x-4 /border-b /border-myPurple-400 py-2 /px-4"
                v-for="col in filteredData" :key="col.symbol">
                <div class="rounded-full overflow-hidden w-20 h-20">
                    <img :src="col.image" alt="" class="min-w-full min-h-full" />
                </div>
                <div class="flex flex-col">
                    <div @click="showPopup(col)"
                        class="cursor-pointer font-inter font-semibold text-lg hover:text-myPurple-400 flex items-center gap-x-2">
                        {{ truncateString(16, col.name) }}
                        <span v-if="col.isBadged">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#5e45ff" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <path
                                    d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z">
                                </path>
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


    <div id="popup" ref="popup"
        class="bg-myDark-100/70 fixed top-0 left-0 w-full h-screen flex items-center justify-center z-10 hidden"
        @click.self="showPopup('')">
        <div class="bg-[#0D0D0D] rounded-xl p-6 w-[70%] mx-auto">
            <div class="grid grid-cols-[1.5fr,2fr] gap-x-8">
                <div class="w-[100%] rounded-xl overflow-hidden">
                    <img :src="col.image" alt="" />
                </div>
                <div class="flex.flex-col">
                    <div class="flex items-center gap-2 text-3xl font-bold my-3">
                        {{ col.name }}
                        <span v-if="col.isBadged">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="#5e45ff" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <path
                                    d="M128,24A104,104,0,1,0,232,128,104.2,104.2,0,0,0,128,24Zm49.5,85.8-58.6,56a8.1,8.1,0,0,1-5.6,2.2,7.7,7.7,0,0,1-5.5-2.2l-29.3-28a8,8,0,1,1,11-11.6l23.8,22.7,53.2-50.7a8,8,0,0,1,11,11.6Z">
                                </path>
                            </svg>
                        </span>
                    </div>
                    <div class="text-myGray leading-relaxed mb-3">
                        {{ col.description }}
                    </div>
                    <div class="flex flex-items justify-between">
                        <div v-if="col.website || col.twitter || col.discord">
                            <div class="mt-4 mb-2 font-semibold">Links
                            </div>
                            <div class="flex itams-center gap-x-3">
                                <span v-if="col.website">
                                    <a :href="col.website" target="_blank" class="hover:text-white block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="26px"
                                            height="26px" viewBox="0 0 512 512">
                                            <title>Globe</title>
                                            <path
                                                d="M256 48C141.13 48 48 141.13 48 256s93.13 208 208 208 208-93.13 208-208S370.87 48 256 48z"
                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                stroke-width="32" />
                                            <path
                                                d="M256 48c-58.07 0-112.67 93.13-112.67 208S197.93 464 256 464s112.67-93.13 112.67-208S314.07 48 256 48z"
                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                stroke-width="32" />
                                            <path
                                                d="M117.33 117.33c38.24 27.15 86.38 43.34 138.67 43.34s100.43-16.19 138.67-43.34M394.67 394.67c-38.24-27.15-86.38-43.34-138.67-43.34s-100.43 16.19-138.67 43.34"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32" />
                                            <path fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                stroke-width="32" d="M256 48v416M464 256H48" />
                                        </svg>
                                    </a>
                                </span>
                                <span v-if="col.twitter">
                                    <a :href="col.twitter" target="_blank" class="hover:text-white font-sm block">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="28px"
                                            height="28px" fill="currentColor">
                                            <path
                                                d="M28,6.937c-0.957,0.425-1.985,0.711-3.064,0.84c1.102-0.66,1.947-1.705,2.345-2.951c-1.03,0.611-2.172,1.055-3.388,1.295 c-0.973-1.037-2.359-1.685-3.893-1.685c-2.946,0-5.334,2.389-5.334,5.334c0,0.418,0.048,0.826,0.138,1.215 c-4.433-0.222-8.363-2.346-10.995-5.574C3.351,6.199,3.088,7.115,3.088,8.094c0,1.85,0.941,3.483,2.372,4.439 c-0.874-0.028-1.697-0.268-2.416-0.667c0,0.023,0,0.044,0,0.067c0,2.585,1.838,4.741,4.279,5.23 c-0.447,0.122-0.919,0.187-1.406,0.187c-0.343,0-0.678-0.034-1.003-0.095c0.679,2.119,2.649,3.662,4.983,3.705 c-1.825,1.431-4.125,2.284-6.625,2.284c-0.43,0-0.855-0.025-1.273-0.075c2.361,1.513,5.164,2.396,8.177,2.396 c9.812,0,15.176-8.128,15.176-15.177c0-0.231-0.005-0.461-0.015-0.69C26.38,8.945,27.285,8.006,28,6.937z" />
                                        </svg>
                                    </a>
                                </span>
                                <span v-if="col.discord">
                                    <a :href="col.discord" target="_blank" class="hover:text-white block">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72" width="28px"
                                            height="28px" fill="currentColor">
                                            <path
                                                d="M54.657,19.077c0,0,8.343,9.663,8.343,27.069v3.65c0,0-10.536,6.866-13.747,6.866l-3.115-4.529	c1.936-0.867,4.577-2.372,4.577-2.372l-0.965-0.747c0,0-6.173,2.86-13.749,2.86s-13.749-2.86-13.749-2.86l-0.965,0.747	c0,0,2.641,1.505,4.577,2.372l-3.115,4.529C19.536,56.662,9,49.796,9,49.796v-3.65c0-17.406,8.343-27.069,8.343-27.069	s5.707-2.762,10.977-3.489l1.635,3.1c0,0,2.599-0.602,6.045-0.602s6.045,0.602,6.045,0.602l1.635-3.1	C48.95,16.315,54.657,19.077,54.657,19.077z M27.01,43.603c2.656,0,4.808-2.418,4.808-5.401c0-2.983-2.153-5.401-4.808-5.401	s-4.808,2.418-4.808,5.401C22.202,41.185,24.354,43.603,27.01,43.603z M44.99,43.603c2.656,0,4.808-2.418,4.808-5.401	c0-2.983-2.153-5.401-4.808-5.401c-2.656,0-4.808,2.418-4.808,5.401C40.182,41.185,42.334,43.603,44.99,43.603z" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div v-if="col.categories && col.categories.length != 0">
                            <div class="mt-4 mb-2 font-semibold">Categories</div>
                            <div class="flex items-center gap-x-2">
                                <div v-for="category in col.categories" :key="category">
                                    <div class="py-1 px-3 bg-myPurple-400 rounded-full text-sm font-semibold capitalize"
                                        v-if="category === 'launchpad'">
                                        Upcoming
                                    </div>
                                    <div v-else
                                        class="py-1 px-3 bg-myPurple-400 rounded-full text-sm font-semibold capitalize">
                                        {{ category }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>