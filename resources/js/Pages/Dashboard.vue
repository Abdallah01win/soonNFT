<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Dialog from "@/Components/Dialog.vue";
//import Editor from "@/Components/Editor.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted } from "vue";
import Navigation from "@/Components/Navigation.vue";
import Editor from "@tinymce/tinymce-vue";
</script>
<script>
const form = useForm({
    name: "",
    description: "",
    dropDate: "",
    imgurl: "",
    price: Number,
    blockchain: "",
    twitter: "",
    discord: "",
    website: "",
    is_featured: Number,
    supply: Number,
});
const postForm = useForm({
    title: "",
    description: "",
    category: "",
    image: "",
    body: "",
});

export default {
    data() {
        return {
            //nftData: this.getNftData(),
            nftCount: this.getNftCount(),
            usersCount: this.getUsersCount(),
            postsCount: this.getPostsCount(),
            formMessage: false,
            postMessage: false,
        };
    },
    components: {
        Navigation,
        Dialog,
        Editor,
    },
    props: {
        comments: Object
    },
    computed: {},
    methods: {
        getNftData() {
            axios
                .get("nfts/count")
                .then((response) => (this.nftData = response.data));
        },
        getNftCount() {
            axios
                .get("nfts/count")
                .then((response) => (this.nftCount = response.data));
        },
        getUsersCount() {
            axios
                .get("users/count")
                .then((response) => (this.usersCount = response.data));
        },
        getPostsCount() {
            axios
                .get("posts/count")
                .then((response) => (this.postsCount = response.data));
        },
        submit() {
            form.post(route("nfts/store"), {
                forceFormData: true,
                onSuccess: () => {
                    form.reset(
                        "name",
                        "supply",
                        "imgurl",
                        "description",
                        "price",
                        "blockchain",
                        "twitter",
                        "website",
                        "is_featured",
                        "discord"
                    );
                    let file = document.getElementById("image");
                    file.value = null;
                    this.formMessage = true;
                    setTimeout(() => {
                        this.formMessage = false;
                    }, 3000);
                    this.getNftCount();
                },
            });
        },
        submitPost() {
            postForm.post(route("posts/store")),{
                forceFormData: true,
                onSuccess: () => {
                    postForm.reset(
                        "body",
                        "category",
                        "description",
                        "image",
                        "title",
                    );
                    let file = document.getElementById("postImage");
                    file.value = null;
                    this.postMessage = true;
                    setTimeout(() => {
                        this.postMessage = false;
                    }, 3000);
                },
            };
        },
    },
};
onMounted(() => {
    //this.getNftCount();
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout class="bg-myDark-300">
        <template v-slot:nav>
            <Navigation class="" />
        </template>
        <!-- Add Nft Form -->
        <section class="mx-auto pt-10 px-[8%] sm:px-0 max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px] border-t border-myDark-100 text-sm sm:text-base">
            <div class="flex flex-col mb-6">
                <div class="text-myPurple-400 text-base font-semibold uppercase">
                    Wellcom back
                </div>
                <h3 class="text-4xl font-bold">Dashboard</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-[2fr,0.7fr] gap-4">
                <form @submit.prevent="this.submit" class="bg-myDark-200 px-5 md:px-8 py-8 md:py-10 rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-2xl font-semibold">
                            Add New NFT
                        </div>
                        <div v-if="formMessage != ''"
                            class="py-1 px-4 text-xs rounded-full bg-green-400 flex items-center gap-2 transition-all ease-out duration-300">
                            <ion-icon name="checkmark-outline"></ion-icon>
                            <span>NFT Saved Successfully</span>
                        </div>
                    </div>
                    <div class="flex max-md:flex-wrap max-md:gap-y-3 items-center gap-x-3 mt-4">
                        <div class="w-full">
                            <TextInput id="NFTname" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autocomplete="name" placeholder="NFT name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="w-full">
                            <TextInput id="supply" type="number" min="1" class="mt-1 block w-full" v-model="form.supply"
                                required autocomplete="supply" placeholder="Supply" />
                            <InputError class="mt-2" :message="form.errors.supply" />
                        </div>
                        <div class="w-full">
                            <lable for="image"
                                class="relative overflow-hidden mt-1 w-full border block cursor-pointer px-4 py-2 border-white text-white/50 rounded-full">
                                <span v-if="form.imgurl === ''" class="flex items-center gap-3">
                                    <span class="w-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 520 520">
                                            <title>Cloud Upload</title>
                                            <path
                                                d="M320 367.79h76c55 0 100-29.21 100-83.6s-53-81.47-96-83.6c-8.89-85.06-71-136.8-144-136.8-69 0-113.44 45.79-128 91.2-60 5.7-112 43.88-112 106.4s54 106.4 120 106.4h56"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32" />
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32"
                                                d="M320 255.79l-64-64-64 64M256 448.21V207.79" />
                                        </svg>
                                    </span>
                                    <span> Upload Image </span>
                                </span>
                                <span v-else class="text-white flex items-center gap-3">
                                    <span class="w-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 520 520">
                                            <title>Cloud Done</title>
                                            <path
                                                d="M400 240c-8.89-89.54-71-144-144-144-69 0-113.44 48.2-128 96-60 6-112 43.59-112 112 0 66 54 112 120 112h260c55 0 100-27.44 100-88 0-59.82-53-85.76-96-88z"
                                                fill="none" stroke="currentColor" stroke-linejoin="round"
                                                stroke-width="32" />
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32"
                                                d="M317 208L209.2 336 163 284.8" />
                                        </svg>
                                    </span>
                                    <span> Image Selected </span>
                                </span>
                                <input class="absolute top-0 left-0 w-full h-[100%] opacity-0" type="file" name="image"
                                    id="image" @input="
                                        form.imgurl = $event.target.files[0]
                                    " />
                            </lable>
                            <InputError class="mt-2" :message="form.errors.imgurl" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                            required autocomplete="name" placeholder="Description" />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="flex max-md:flex-wrap max-md:gap-y-3 items-center gap-x-3 mt-4">
                        <div class="w-full">
                            <TextInput id="twitter" type="text" class="mt-1 block w-full" v-model="form.twitter"
                                autocomplete="twitter" placeholder="Twitter Link" />
                            <InputError class="mt-2" :message="form.errors.twitter" />
                        </div>
                        <div class="w-full">
                            <TextInput id="discord" type="text" class="mt-1 block w-full" v-model="form.discord"
                                autocomplete="discord" placeholder="Discord Link" />
                            <InputError class="mt-2" :message="form.errors.discord" />
                        </div>
                        <div class="w-full">
                            <TextInput id="website" type="text" class="mt-1 block w-full" v-model="form.website"
                                autocomplete="website" placeholder="Website Link" />
                            <InputError class="mt-2" :message="form.errors.website" />
                        </div>
                    </div>
                    <div class="flex max-md:flex-wrap max-md:gap-y-3 items-center gap-x-3 mt-4">
                        <div class="w-full">
                            <TextInput id="price" type="number" step="0.001" min="0" class="mt-1 block w-full"
                                v-model="form.price" required autocomplete="price" placeholder="Price" />
                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                        <div class="w-full">
                            <select
                                class="border-white focus:border-white focus:ring-white rounded-full bg-transparent placeholder:text-white/50 pl-5 w-full"
                                name="Blockchain" id="Blockchain" v-model="form.blockchain" required>
                                <option class="bg-black" value="" disabled selected>
                                    Blockchain
                                </option>
                                <option class="bg-black" value="ethereum">
                                    Ethereum
                                </option>
                                <option class="bg-black" value="solana">
                                    Solana
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.blockchain" />
                        </div>
                        <div class="w-full">
                            <select
                                class="border-white focus:border-white focus:ring-white rounded-full bg-transparent placeholder:text-white/50 pl-5 w-full"
                                name="is_featured" id="is_featured" v-model="form.is_featured" required>
                                <option class="bg-black" value="1">
                                    Featured
                                </option>
                                <option class="bg-black" value="0">
                                    Not Featured
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.is_featured" />
                        </div>
                    </div>

                    <PrimaryButton class="w-full justify-center mt-5" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Submit NFT
                    </PrimaryButton>
                </form>

                <div class="flex flex-wrap flex-row md:flex-col max-md:grow gap-4">
                    <div class="max-md:grow flex flex-col gap-y-2 bg-myDark-200 px-8 py-6 rounded-xl">
                        <span class="text-myGray text-sm">Total Users</span>
                        <span class="font-bold text-3xl">{{ usersCount }}</span>
                    </div>
                    <div class="max-md:grow flex flex-col gap-y-2 bg-myDark-200 px-8 py-6 rounded-xl">
                        <span class="text-myGray text-sm">Total NFTs</span>
                        <span class="font-bold text-3xl">{{ nftCount }}</span>
                    </div>
                    <div class="max-md:grow flex flex-col gap-y-2 bg-myDark-200 px-8 py-6 rounded-xl">
                        <span class="text-myGray text-sm">Blog Posts</span>
                        <span class="font-bold text-3xl">{{ postsCount }}</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Add Nft Form -->

        <!-- Add Blogpost Form -->
        <section class="mx-auto pt-10 px-[8%] sm:px-0 max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px] text-sm sm:text-base">
            <form @submit.prevent="this.submitPost" class="bg-myDark-200 px-5 md:px-8 py-8 md:py-10 rounded-xl">
                <div class="flex max-md:flex-wrap max-md:gap-y-3 items-center justify-between mb-4">
                    <div class="text-2xl font-semibold">
                        Write New Blog Post
                    </div>
                    <div v-if="postMessage != ''"
                        class="py-1 px-4 text-xs rounded-full bg-green-400 flex items-center gap-2 transition-all ease-out duration-300">
                        <ion-icon name="checkmark-outline"></ion-icon>
                        <span>Post Saved Successfully</span>
                    </div>
                </div>
                <div class="flex max-md:flex-wrap max-md:gap-y-3 items-center gap-x-3 my-4">
                    <div class="w-full">
                        <TextInput id="postTitle" type="text" class="mt-1 block w-full" v-model="postForm.title"
                            required autocomplete="postTitle" placeholder="Title" />
                        <InputError class="mt-2" :message="postForm.errors.title" />
                    </div>
                    <div class="w-full">
                        <select
                            class="border-white focus:border-white focus:ring-white rounded-full bg-transparent placeholder:text-white/50 pl-5 w-full"
                            name="postCategory" id="postCategory" v-model="postForm.category" required>
                            <option class="bg-black" value="" disabled selected>
                                Category
                            </option>
                            <option class="bg-black" value="ethereum">
                                Ethereum
                            </option>
                            <option class="bg-black" value="solana">
                                Solana
                            </option>
                            <option class="bg-black" value="NFTs">
                                NFTs
                            </option>
                        </select>
                        <InputError class="mt-2" :message="postForm.errors.category" />
                    </div>
                    <div class="w-full">
                        <lable for="image"
                            class="relative overflow-hidden mt-1 w-full border block cursor-pointer px-4 py-2 border-white text-white/50 rounded-full">
                            <span v-if="postForm.image === ''" class="flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 520 520">
                                        <title>Cloud Upload</title>
                                        <path
                                            d="M320 367.79h76c55 0 100-29.21 100-83.6s-53-81.47-96-83.6c-8.89-85.06-71-136.8-144-136.8-69 0-113.44 45.79-128 91.2-60 5.7-112 43.88-112 106.4s54 106.4 120 106.4h56"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M320 255.79l-64-64-64 64M256 448.21V207.79" />
                                    </svg>
                                </span>
                                <span> Upload Image </span>
                            </span>
                            <span v-else class="text-white flex items-center gap-3">
                                <span class="w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 520 520">
                                        <title>Cloud Done</title>
                                        <path
                                            d="M400 240c-8.89-89.54-71-144-144-144-69 0-113.44 48.2-128 96-60 6-112 43.59-112 112 0 66 54 112 120 112h260c55 0 100-27.44 100-88 0-59.82-53-85.76-96-88z"
                                            fill="none" stroke="currentColor" stroke-linejoin="round"
                                            stroke-width="32" />
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32"
                                            d="M317 208L209.2 336 163 284.8" />
                                    </svg>
                                </span>
                                <span> Image Selected </span>
                            </span>
                            <input class="absolute top-0 left-0 w-full h-[100%] opacity-0" type="file" name="image"
                                id="postImage" @input="postForm.image = $event.target.files[0]
                                " />
                        </lable>
                        <InputError class="mt-2" :message="postForm.errors.image" />
                    </div>
                </div>
                <div class="w-full mb-4">
                    <TextInput id="postDescription" maxlength="254" type="text" class="mt-1 block w-full"
                        v-model="postForm.description" required autocomplete="postDescription"
                        placeholder="Description" />
                    <InputError class="mt-2" :message="postForm.errors.description" />
                </div>
                <!-- Editor -->
                <editor v-model="postForm.body" api-key="qy087j2ri5rtqec2z8zfm30dlp512h2wdodz9lu5gziom42d" :init="{
                    height: 500,
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount typography inlinecss',
                    ],
                    toolbar:
                        'undo redo | formatselect blocks fontfamily fontsize | bold italic underline strikethrough | link mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                }" />
                <!-- <Editor /> -->

                <div class="flex items-center gap-x-4 w-full">
                    <PrimaryButton type="submit" class="w-full justify-center mt-5"
                        :class="{ 'opacity-25': postForm.processing }" :disabled="postForm.processing">
                        Publish Post
                    </PrimaryButton>
                </div>
            </form>
        </section>
        <!-- End Add Blogpost Form -->

        <!-- Commments -->
        <!-- <section class="mx-auto my-8 max-w-[1180px]">
            <div class="bg-myDark-200 px-8 py-10 rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-2xl font-semibold">
                        Aprove Comments
                    </div>
                    <div v-if="commentApproved != ''"
                        class="py-1 px-4 text-xs rounded-full bg-green-400 flex items-center gap-2 transition-all ease-out duration-300">
                        <ion-icon name="checkmark-outline"></ion-icon>
                        <span>Comment Approved</span>
                    </div>
                </div>
                <div v-if="comments.lenght != 0" class="grid grid-cols-4 gap-6 my-6">
                    <div v-for="comment in comments" :key="comment.id">
                        <div class="bg-myDark-100 rounded-xl py-3 px-4">
                            <div class="my-3">
                                {{ comment.comment }}
                            </div>
                            <div class="flex items-center gap-x-3">
                                <Link
                                    class="w-full rounded-full px-2 py-1 bg-white text-black hover:bg-white/70 flex items-center justify-center">
                                Add</Link>
                                <Link
                                    class="w-full rounded-full px-2 py-1 bg-white text-black hover:bg-white/70 flex items-center justify-center">
                                Remove</Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p>No More Comments to Show.</p>
                </div>
            </div>
        </section> -->
        <!-- End Commments -->

    </AuthenticatedLayout>
</template>

<style>
::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
</style>
