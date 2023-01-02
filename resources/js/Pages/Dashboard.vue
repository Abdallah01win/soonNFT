<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';


const form = useForm({
    name: '',
    description: '',
    dropDate: '',
    imgUrl: '',
    price: Number,
    blockchain: '',
    twitter: '',
    discord: '',
    website: '',

});
</script>
<script>
import Navigation from '@/Components/Navigation.vue'
export default {
    components: {
        Navigation,
    }
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout class="bg-black">
        <template v-slot:nav>
            <Navigation class="" />
            <!-- Stats Section -->
            <!-- <section></section> -->
            <!-- End Stats Sections -->

            <!-- Add Nft Form -->
            <section class="mx-auto my-12 max-w-[1180px]">
                <div class="flex flex-col mb-6">
                    <div class="text-white opacity-50 text-lg">Wellcom back</div>
                    <h3 class="text-4xl font-bold">Dashboard</h3>
                </div>
                <div class="grid grid-cols-[2fr,0.9fr] gap-x-4">
                    <form action="post" class="bg-myDark-200 px-8 py-10 rounded-xl">
                        <div class="text-2xl font-semibold mb-4">Add New NFT</div>

                        <div>
                            <TextInput id="NFTname" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autocomplete="name" placeholder="NFT name" />
                            <InputError class="mt-2" :message="form.errors.name" />
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
                                <TextInput id="price" type="number" class="mt-1 block w-full" v-model="form.price"
                                    required autocomplete="price" placeholder="Price" />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>
                            <div class="w-full">
                                <select
                                    class="border-white focus:border-white focus:ring-white rounded-full bg-transparent placeholder:text-white/50 pl-5 w-full"
                                    name="Blockchain" id="Blockchain" v-model="form.blockchain" required>
                                    <option class="bg-black" value="ethereum">Ethereum</option>
                                    <option class="bg-black" value="solana">Solana</option>
                                    <option class="bg-black" value="bitcoin">Bitcoin</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.blockchain" />
                            </div>
                            <div class="w-full">
                                <TextInput id="Date" type="text" class="mt-1 block w-full" v-model="form.dropDate"
                                    required autocomplete="Date" placeholder="Drop Date" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                                <InputError class="mt-2" :message="form.errors.dropDate" />
                            </div>
                        </div>
                        <!-- <div>
                            <TextInput id="img" type="file" class="mt-1 block w-full" v-model="form.imgUrl" required
                                autocomplete="image" placeholder="image" />
                            <InputError class="mt-2" :message="form.errors.imgUrl" />
                        </div> -->



                        <PrimaryButton class="w-full justify-center mt-5" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Submit NFT
                        </PrimaryButton>
                    </form>

                    <!-- stats -->
                    <div class="bg-myDark-200 px-8 py-10 rounded-xl">
                        <div class="text-2xl font-semibold mb-4">Statestics</div>
                        <div class="flex flex-col gap-y-4">
                            <div class="flex items-center justify-between">
                                <span>Blog Posts</span>
                                <span>124</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Total NFTs</span>
                                <span>124</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Total Users</span>
                                <span>124</span>
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
