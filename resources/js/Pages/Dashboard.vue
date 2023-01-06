<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";
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
            nftCount: this.getNftCount(),
            usersCount: this.getUsersCount(),
            formMessage: false,
        };
    },
    components: {
        Navigation,
    },
    computed: {},
    methods: {
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
                    this.formMessage = true;
                    setTimeout(() => {
                        this.formMessage = false;
                    }, 3000);
                    this.getNftCount();
                },
            });
        },
    },
    mounted: function () {
        //this.getNftCount();
    },
};

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
                                <!-- <TextInput id="imgurl" type="file" @input="form.imgurl = $event.target.files[0]" class="mt-1 block w-full" v-model="form.imgurl"
                                    required autocomplete="imgurl" placeholder="Upload Image" /> -->
                                    <input
                                    type="file"
                                    name="image"
                                    @input="form.imgurl = $event.target.files[0]"
                                />
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
                                    required autocomplete="twitter" placeholder="Twitter Link" />
                                <InputError class="mt-2" :message="form.errors.twitter" />
                            </div>
                            <div class="w-full">
                                <TextInput id="discord" type="text" class="mt-1 block w-full" v-model="form.discord"
                                    required autocomplete="discord" placeholder="Discord Link" />
                                <InputError class="mt-2" :message="form.errors.discord" />
                            </div>
                            <div class="w-full">
                                <TextInput id="website" type="text" class="mt-1 block w-full" v-model="form.website"
                                    required autocomplete="website" placeholder="Website Link" />
                                <InputError class="mt-2" :message="form.errors.website" />
                            </div>
                        </div>
                        <div class="flex items-center gap-x-3 mt-4">
                            <div class="w-full">
                                <TextInput id="price" type="number" min="0" class="mt-1 block w-full"
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
                                <!-- <span class="font-bold">{{
        nftCount[0].count +
        nftCount[1].count +
        nftCount[2].count
                                    }}</span>-->
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
