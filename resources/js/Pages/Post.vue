<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';

export default {
    data() {
        return {
            hover: false
        }
    },
    components: {
        Head,
        Link,
        Navigation,
        Footer,
    },
    props: {
        post: Object,
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },
    }
}
</script>
<template>

    <Head title="Post" />
    <Navigation />
    <!-- {{ post }} -->
    <section class="mx-auto my-10 max-w-[1180px]">

        <div class="grid grid-cols-[1fr,0.5fr] gap-x-10">
            <div>
                <!-- Post Header -->
                <div class="relative">
                    <img src="../../../storage/app/public/assets/hero2.png" alt=""
                        class="w-full h-[440px] rounded-3xl overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full flex items-end py-8 px-8 rounded-3xl overflow-hidden"
                        style="background: linear-gradient(180deg, rgba(30,30,30,0.25) 0%, rgba(3,3,3,.9) 100%);">
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between mb-2">
                                <div class="bg-myPurple-400 mb-1 rounded-full px-5 py-1 w-fit">{{ post.category }}</div>

                                <div class="flex items-center">
                                    <img alt="testimonial" src="https://dummyimage.com/106x106"
                                        class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center" />
                                    <span class="/flex-grow flex flex-col pl-3">
                                        <span class="title-font font-medium">{{ post.name }}</span>
                                    </span>
                                    <span class="flex items-center gap-x-2 pl-4">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="26px"
                                                height="26px" viewBox="0 0 512 512">
                                                <title>Time</title>
                                                <path
                                                    d="M256 64C150 64 64 150 64 256s86 192 192 192 192-86 192-192S362 64 256 64z"
                                                    fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                    stroke-width="32" />
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32" d="M256 128v144h96" />
                                            </svg>
                                        </span>
                                        <span>
                                            {{ dateConvert(post.created_at).date }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="text-3xl font-semibold /mb-4">{{ post.title }}</div>

                        </div>
                    </div>
                </div>
                <!-- End Post Header -->

                <!-- Post Body -->
                <div class="leading-relaxed my-10 text-myGray">
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor consectetur iure
                        rerum deserunt esse! Porro perferendis, totam explicabo laboriosam reiciendis doloremque
                        laudantium, mollitia obcaecati laborum magni omnis libero architecto repudiandae est?
                        Consequatur, officiis error eligendi, iusto itaque voluptatum, necessitatibus tempore
                        voluptatibus amet sed dolor rem maiores reiciendis. Distinctio, est nisi!</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor consectetur iure
                        rerum deserunt esse! Porro perferendis, totam explicabo laboriosam reiciendis doloremque
                        laudantium, mollitia obcaecati laborum magni omnis libero architecto repudiandae est?
                        Consequatur, officiis error eligendi, iusto itaque voluptatum, necessitatibus tempore
                        voluptatibus amet sed dolor rem maiores reiciendis. Distinctio, est nisi!</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor consectetur iure
                        rerum deserunt esse! Porro perferendis, totam explicabo laboriosam reiciendis doloremque
                        laudantium, mollitia obcaecati laborum magni omnis libero architecto repudiandae est?
                        Consequatur, officiis error eligendi, iusto itaque voluptatum, necessitatibus tempore
                        voluptatibus amet sed dolor rem maiores reiciendis. Distinctio, est nisi!</p>
                </div>
                <!-- End Body -->
            </div>


            <div class="leading-relaxed flex flex-col">
                <div>
                    <div class="mt-3 mb-6">
                        <div class="text-myPurple-400 text-base font-semibold uppercase">
                            Posts
                        </div>
                        <h3 class="text-2xl font-bold">Suggested Stories</h3>
                    </div>
                    <div class="flex flex-col gap-y-6">
                        <div class="relative">
                            <img src="../../../storage/app/public/assets/hero2.png" alt=""
                                class="w-full h-[265px] rounded-3xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-full flex items-end py-6 px-6 rounded-3xl overflow-hidden"
                                style="background: linear-gradient(180deg, rgba(30,30,30,0.25) 0%, rgba(3,3,3,.9) 100%);">
                                <div class="flex flex-col">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="bg-myPurple-400 rounded-full px-4 py-1 w-fit text-xs">{{
                                            post.category
                                        }}</div>
                                    </div>
                                    <div class="text-xl font-semibold /mb-4">{{ post.title }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="../../../storage/app/public/assets/hero2.png" alt=""
                                class="w-full h-[265px] rounded-3xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-full flex items-end py-6 px-6 rounded-3xl overflow-hidden"
                                style="background: linear-gradient(180deg, rgba(30,30,30,0.25) 0%, rgba(3,3,3,.9) 100%);">
                                <div class="flex flex-col">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="bg-myPurple-400 rounded-full px-4 py-1 w-fit text-xs">{{
                                            post.category
                                        }}</div>
                                    </div>
                                    <div class="text-xl font-semibold /mb-4">{{ post.title }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="../../../storage/app/public/assets/hero2.png" alt=""
                                class="w-full h-[265px] rounded-3xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-full flex items-end py-6 px-6 rounded-3xl overflow-hidden"
                                style="background: linear-gradient(180deg, rgba(30,30,30,0.25) 0%, rgba(3,3,3,.9) 100%);">
                                <div class="flex flex-col">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="bg-myPurple-400 rounded-full px-4 py-1 w-fit text-xs">{{
                                            post.category
                                        }}</div>
                                    </div>
                                    <div class="text-xl font-semibold /mb-4">{{ post.title }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="grid grid-cols-3 gap-14 mt-14">
        <div v-for="item in posts.slice(1)" :key="item.id">
            <PostCard :item="item"/>
        </div>
        </div> -->
    </section>
    <Footer />
</template>