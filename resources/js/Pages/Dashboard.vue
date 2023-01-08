<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Dialog from "@/Components/Dialog.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted } from 'vue'

</script>
<script>
import Navigation from "@/Components/Navigation.vue";
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
    supply: Number,
});

export default {
    data() {
        return {
            nftData: this.getNftData(),
            nftCount: '',
            usersCount: this.getUsersCount(),
            formMessage: false,
        };
    },
    components: {
        Navigation,
        Dialog
    },
    computed: {},
    methods: {
        getNftData() {
            axios
                .get("nfts/count")
                .then((response) => (this.nftData = response.data));
        },
        getNftCount() {
            let count = 0
            for (let i = 0; i < this.nftData.length; i++) {
                const element = this.nftData[i];
                count += element.count;
            }
            this.nftCount = count;
        },
        getUsersCount() {
            axios
                .get("users/count")
                .then((response) => (this.usersCount = response.data));
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
                        "discord",
                        "dropDate"
                    );
                    let file = document.getElementById('image');
                    file.value = null;
                    this.formMessage = true;
                    setTimeout(() => {
                        this.formMessage = false;
                    }, 3000);
                    this.getNftCount();
                },
            });
        },
    },
};

onMounted(() => {
    this.getNftCount();
})

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout class="bg-black">
        <template v-slot:nav>
            <Navigation class="" />

            <!-- Add Nft Form -->
            <section class="mx-auto my-8 max-w-[1180px]">
                <div class="flex flex-col mb-6">
                    <div class="text-white opacity-50 text-lg">
                        Wellcom back
                    </div>
                    <h3 class="text-4xl font-bold">Dashboard</h3>
                </div>
                <div class="grid grid-cols-[2fr,0.9fr] gap-x-4">
                    <form @submit.prevent="this.submit" class="bg-myDark-200 px-8 py-10 rounded-xl">
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
                        <div class="flex items-center gap-x-3 mt-4">
                            <div class="w-full">
                                <TextInput id="NFTname" type="text" class="mt-1 block w-full" v-model="form.name"
                                    required autocomplete="name" placeholder="NFT name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="w-full">
                                <TextInput id="supply" type="number" min="1" class="mt-1 block w-full"
                                    v-model="form.supply" required autocomplete="supply" placeholder="Supply" />
                                <InputError class="mt-2" :message="form.errors.supply" />
                            </div>
                            <div class="w-full">
                                <lable for="image"
                                    class="relative overflow-hidden mt-1 w-full border block cursor-pointer px-4 py-2 border-white text-white/50 rounded-full">
                                    <span v-if="form.imgurl === ''" class="flex items-center gap-3">
                                        <span class="w-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                                viewBox="0 0 520 520">
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
                                        <span>
                                            Upload Image
                                        </span>
                                    </span>
                                    <span v-else class="text-white flex items-center gap-3">
                                        <span class="w-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon"
                                                viewBox="0 0 520 520">
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
                                        <span>
                                            Image Selected
                                        </span>
                                    </span>
                                    <input class="absolute top-0 left-0 w-full h-[100%] opacity-0" type="file"
                                        name="image" id="image" @input="form.imgurl = $event.target.files[0]" />
                                </lable>
                                <InputError class="mt-2" :message="form.errors.imgurl" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                                required autocomplete="name" placeholder="Description" />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>
                        <div class="flex items-center gap-x-3 mt-4">
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
                        <div class="flex items-center gap-x-3 mt-4">
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
                                    <option class="bg-black" value="bitcoin">
                                        Bitcoin
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.blockchain" />
                            </div>
                            <div class="w-full">
                                <TextInput id="Date" type="text" class="mt-1 block w-full" v-model="form.dropDate"
                                    required autocomplete="Date" placeholder="Drop Date" onfocus="(this.type='date')"
                                    onblur="(this.type='text')" />
                                <InputError class="mt-2" :message="form.errors.dropDate" />
                            </div>
                        </div>

                        <PrimaryButton class="w-full justify-center mt-5" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Submit NFT
                        </PrimaryButton>
                    </form>

                    <!-- stats -->
                    <div class="bg-myDark-200 px-8 py-10 rounded-xl">
                        <div class="text-2xl font-semibold mb-4">
                            Statestics
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <div class="flex items-center justify-between">
                                <span>Blog Posts</span>
                                <span class="font-bold">124</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Total Users</span>
                                <span class="font-bold">{{ usersCount }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Total NFTs</span>
                                <span class="font-bold">{{ nftCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Add Nft Form -->
        </template>
    </AuthenticatedLayout>
</template>

<style>
::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
</style>
