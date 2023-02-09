<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

</script >

<script>


const form = useForm({
    comment: "",
    post_id: "",
});

export default {
    data() {
        return {
            hover: false,
            formMessage: false,
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
        similar: Object,
        comments: Object,
    },
    methods: {
        dateConvert(date) {
            let newDate = new Date(date);
            let myDate = {};
            myDate.date = newDate.toString().substring(0, 10);
            myDate.time = newDate.toString().substring(16, 24);
            return myDate;
        },

        submit() {
            form.transform((data) => ({
                ...data,
                post_id: data.post_id ? this.post.id : this.post.id,
            }))
                .post(route("comment/creat"), {
                    onSuccess: () => {
                        form.reset(
                            "comment"
                        );
                        this.formMessage = true;
                        setTimeout(() => {
                            this.formMessage = false;
                        }, 3000);
                        this.getNftCount();
                    },
                });
        },
    }
}
</script>
<template>

    <Head title="Post" />
    <Navigation />
    <section class="mx-auto my-10 max-w-[1180px]">

        <div class="grid grid-cols-[1fr,0.5fr] gap-x-10">
            <div>
                <!-- Post Header -->
                <div class="relative">
                    <img :src="post.image" alt="" class="w-full h-[440px] rounded-3xl overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full flex items-end py-8 px-8 rounded-3xl overflow-hidden"
                        style="background: linear-gradient(180deg, rgba(30,30,30,0.25) 0%, rgba(3,3,3,.9) 100%);">
                        <div class="flex flex-col w-full">
                            <div class="flex items-center justify-between mb-2">
                                <div class="bg-myPurple-400 mb-1 rounded-full px-5 py-1 w-fit font-semibold">{{ post.category }}</div>

                                <div class="flex items-center">
                                    <img alt="testimonial" :src="post.image_url"
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
                            <div class="text-3xl font-semibold">{{ post.title }}</div>

                        </div>
                    </div>
                </div>
                <!-- End Post Header -->

                <!-- Post Body -->
                <div v-html="post.body" class="leading-relaxed my-10 text-myGray" id="postBody">
                </div>
                <!-- End Body -->

                <!-- Comments Section -->
                <!-- <div class="bg-myDark-400 rounded-3xl px-10 py-12">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-myPurple-400 text-sm font-semibold uppercase">
                                Comments
                            </div>
                            <h3 class="text-2xl font-bold ">
                                <span v-if="comments.length > 0">Join The</span>
                                <span v-else>Start A</span>
                                Conversation
                            </h3>
                        </div>

                        <div v-if="formMessage" class="py-1 px-4 text-sm bg-green-600 rounded-full w-fit mt-3">Your
                            Comment is uder review. Thank you.</div>
                    </div>


                    <div v-if="comments.length > 0" class="flex flex-col gap-y-6 mt-6 pb-6">
                        <div v-for="comment in comments" :key="comment.id">
                            <div class="inline-flex items-center">
                                <img alt="testimonial" src="https://dummyimage.com/106x106"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center" />
                                <div class="flex-grow flex flex-col pl-4 /text-white">
                                    <span class="title-font font-medium">
                                        <span>{{ comment.name }} | </span>
                                        <span>{{ dateConvert(comment.created_at).date }}</span>
                                    </span>
                                    <span class="text-base capitalize text-myGray font-semibold">{{
                                        comment.comment
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form @submit.prevent="this.submit">
                            <p v-if="!$page.props.auth.user" class="mt-4">Login and let us know what you think.</p>
                            <div class="w-full flex items-center gap-x-3 mt-4">
                                <TextInput id="comment" type="text" class="block grow" autocomplete="comment"
                                    placeholder="Your Comment" max="75" v-model="form.comment" />
                                <InputError class="mt-2" :message="form.errors.comment" />
                                <PrimaryButton class="px-6">Submit comment</PrimaryButton>
                            </div>

                        </form>
                    </div>
                </div> -->
                <!-- End Comments Section -->
            </div>


            <div class="leading-relaxed flex flex-col">
                <div>
                    <div class="mt-3 mb-6">
                        <div class="text-myPurple-400 text-base font-semibold uppercase">
                            Posts
                        </div>
                        <h3 class="mt-[-3px] text-2xl font-bold">Suggested Stories</h3>
                    </div>
                    <div class="flex flex-col gap-y-6">
                        <div class="relative" v-for="post in similar" :key="post.id">
                            <img :src="post.image" alt=""
                                class="w-full h-[250px] rounded-3xl overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-full flex items-end py-6 px-6 rounded-3xl overflow-hidden"
                                style="background: linear-gradient(180deg, rgba(30,30,30,0.25) 0%, rgba(3,3,3,.9) 100%);">
                                <div class="flex flex-col">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="bg-myPurple-400 rounded-full px-4 py-1 w-fit text-xs">{{
                                            post.category
                                        }}</div>
                                    </div>
                                    <Link class="text-xl font-semibold hover:text-myPurple-400 cursor-pointer text-left"
                                        :href="route('post')" method="POST" as="button" :data="{ id: post.id }">
                                    {{ post.title }}
                                    </Link>
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

<style>
#postBody h1, h2, h3, h4, h5, h6{
    color: white;
    font-size: larger;
    font-weight: 700;
    margin: 6px 0px;
}
#postBody h6{
    font-size: 14px;
}
#postBody h5{
    font-size: 16px;
}
#postBody h4{
    font-size: 18px;
}
#postBody h3{
    font-size: 20px;
}
#postBody h2{
    font-size: 24px;
}
#postBody h1{
    font-size: 30px;
}

#postBody a{
    color:#5e45ff;
    text-underline-offset: 2px;
    text-decoration: underline;
}

#postBody a:hover{
    color:#3930cf;
}

#postBody ul, ol{
    list-style-type: disc;
    display: block;
    padding: 12px 0px 0px 30px;
}
#postBody ul{
    list-style-type: disc;
}
#postBody ol{
    list-style-type: decimal;
}
</style>