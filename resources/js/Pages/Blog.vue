<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navigation from "@/Components/Navigation.vue";
import PostCard from "@/Components/PostCard.vue";
import Footer from "@/Components/Footer.vue";

export default {
    data() {
        return {
            hover: false,
            selectedCategory: "",
            selectedOrder: "desc",
            categories: [],
        };
    },
    components: {
        Head,
        Link,
        Navigation,
        PostCard,
        Footer,
    },
    computed: {
        filteredPosts() {
            let filtered = this.posts;

            if (this.selectedCategory) {
                filtered = filtered.filter(
                    (post) => post.category === this.selectedCategory
                );
            }

            filtered.sort((a, b) => {
                if (this.selectedOrder === "asc") {
                    return new Date(a.created_at) - new Date(b.created_at);
                } else {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            return filtered;
        },
    },
    props: {
        posts: Object,
    },
    mounted() {
        this.categories = [...new Set(this.posts.map((post) => post.category))];
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },
        selectOption(option) {
            this.selectedCategory = option;
        },
        SelectedOrder(option) {
            this.selectedOrder = option;
        },
    },
};
</script>
<template>

    <Head title="Blog" />
    <Navigation />
    <!-- {{ posts }} -->
    <section class="mx-auto my-12 max-w-[1180px]">
        <div class="flex items-center justify-between mb-10">
            <div class="flex flex-col">
                <div class="text-myPurple-400 text-base font-semibold uppercase">
                    Blog
                </div>
                <h3 class="text-4xl font-bold">Latest Stories</h3>
            </div>



            <div class="flex items-center gap-x-5">
                <div
                    class="relative text-sm flex border-[3px] border-myPurple-400 bg-transparent rounded-full py-2 px-2 /font-semibold leading-relaxed">
                    <button @click="selectOption('')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': '' === selectedCategory}">
                        All
                    </button>
                    <button v-for="(option, index) in categories" :key="index" @click="selectOption(option)"
                        class="py-1 px-5 rounded-full transition-colors capitalize"
                        :class="{ 'bg-myPurple-400': option === selectedCategory }">
                        {{ option }}
                    </button>
                </div>

                <div
                    class="relative text-sm flex border-[3px] border-myPurple-400 bg-transparent rounded-full py-2 px-2 /font-semibold leading-relaxed">
                    <button @click="SelectedOrder('desc')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': 'desc' === selectedOrder }">
                        Newest
                    </button>
                    <button @click="SelectedOrder('asc')" class="py-1 px-5 rounded-full transition-colors"
                        :class="{ 'bg-myPurple-400': 'asc' === selectedOrder }">
                        Oldest
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-[0.75fr,1fr] gap-x-10">
            <div class="relative" @mouseover="hover = true" @mouseleave="hover = false">
                <img :src="filteredPosts[0].image" alt="" class="w-full h-[300px] rounded-3xl overflow-hidden" />
                <div v-if="hover"
                    class="transition-all absolute top-0 left-0 flex items-center justify-center w-full h-full bg-myDark-100/60 rounded-3xl">
                    <Link :href="route('post')" method="post" as="button" :data="{ id: filteredPosts[0].id }">
                    <div
                        class="w-16 h-16 rounded-full bg-myPurple-400 hover:bg-myPurple-300 text-white flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" width="28px" fill="#fff"
                            viewBox="0 0 512 512">
                            <title>Navigate</title>
                            <path
                                d="M272 464a16 16 0 01-16-16.42V264.13a8 8 0 00-8-8H64.41a16.31 16.31 0 01-15.49-10.65 16 16 0 018.41-19.87l384-176.15a16 16 0 0121.22 21.19l-176 384A16 16 0 01272 464z" />
                        </svg>
                    </div>
                    </Link>
                </div>
            </div>

            <div class="leading-relaxed flex flex-col justify-center">
                <div class="bg-myPurple-400 text-base text-white w-fit rounded-full px-4 py-2-1 font-semibold my-1">
                    {{ filteredPosts[0].category }}
                </div>
                <div class="text-4xl font-semibold mb-4">
                    {{ filteredPosts[0].title }}
                </div>
                <p class="text-myGray w-[90%] mb-4">
                    {{ filteredPosts[0].description }}
                </p>
                <div class="flex items-center">
                    <img alt="testimonial" :src="filteredPosts[0].image_url"
                        class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center" />
                    <span class="flex-grow flex flex-col pl-4">
                        <span class="title-font font-medium">{{
                            filteredPosts[0].name
                        }}</span>
                        <span class="text-sm text-myGray font-semibold">{{
                            dateConvert(filteredPosts[0].created_at).date
                        }}</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-14 mt-14">
            <div v-for="item in filteredPosts.slice(1)" :key="item.id">
                <PostCard :item="item" />
            </div>
        </div>
    </section>
    <Footer />
</template>
