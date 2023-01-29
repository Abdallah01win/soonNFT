<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import PostCard from '@/Components/PostCard.vue'
import Footer from '@/Components/Footer.vue';

export default {
    data(){
        return{
            firstPost: this.posts[0],
            hover: false
        }
    },
    components: {
        Head,
        Link,
        Navigation,
        PostCard,
        Footer,
    },
    props: {
        posts: Object,
    },
    methods:{
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

    <Head title="Blog" />
    <Navigation />
    <!-- {{ posts }} -->
    <section class="mx-auto my-12 max-w-[1180px]">
        <div class="flex items-center justify-between">
        <div class="flex flex-col mb-10">
            <div class="text-myPurple-400 text-base font-semibold uppercase">
                Blog
            </div>
            <h3 class="text-4xl font-bold">Latest Stories</h3>
        </div>

        <div class="flex items-center gap-x-5">
            <div class="rounded-full bg-myPurple-400 py-1 px-5 cursor-pointer hover:bg-myPurple-300">All</div>
            <div class="rounded-full bg-myPurple-400 py-1 px-5 cursor-pointer hover:bg-myPurple-300">Solana</div>
            <div class="rounded-full bg-myPurple-400 py-1 px-5 cursor-pointer hover:bg-myPurple-300">Ethereum</div>
        </div>
    </div>

    <div class="grid grid-cols-[0.75fr,1fr] gap-x-10">

        <div class="relative" @mouseover="hover = true" @mouseleave="hover = false">
            <img src="../../../storage/app/public/assets/hero2.png" alt="" class="w-full h-[300px] rounded-3xl overflow-hidden">
            <div v-if="hover" class="transition-all absolute top-0 left-0 flex items-center justify-center w-full h-full bg-myDark-100/60 rounded-3xl">
                <Link :href="route('post')" method="post" as="button" :data="{ id: firstPost.id }">
                    <div class="w-16 h-16 rounded-full bg-myPurple-400 hover:bg-myPurple-300 text-white flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="28px" fill="#fff" viewBox="0 0 512 512"><title>Navigate</title><path d="M272 464a16 16 0 01-16-16.42V264.13a8 8 0 00-8-8H64.41a16.31 16.31 0 01-15.49-10.65 16 16 0 018.41-19.87l384-176.15a16 16 0 0121.22 21.19l-176 384A16 16 0 01272 464z"/></svg>
                    </div>
                </Link>
            </div>
        </div>

        <div class="leading-relaxed flex flex-col justify-center">
            <div class="text-myPurple-400 text-base font-semibold my-1">{{ firstPost.category}}</div>
            <div class="text-4xl  font-semibold mb-4">{{ firstPost.title }}</div>
            <p class="text-myGray w-[90%] mb-4">{{ firstPost.description }}</p>
            <div class="flex items-center">
              <img
                alt="testimonial"
                src="https://dummyimage.com/106x106"
                class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center"
              />
              <span class="flex-grow flex flex-col pl-4">
                <span class="title-font font-medium">{{ firstPost.name }}</span>
                <span class="text-sm text-myGray font-semibold">{{ dateConvert(firstPost.created_at).date }}</span>
              </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-14 mt-14">
        <div v-for="item in posts.slice(1)" :key="item.id">
            <PostCard :item="item"/>
        </div>
        </div>
    </section>
    <Footer />
</template>