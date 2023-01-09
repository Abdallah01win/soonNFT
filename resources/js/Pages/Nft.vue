<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Navigation from "@/Components/Navigation.vue";
</script>
<script>
export default {
    props: {
        nft: Object,
    },
    components: {
        Navigation,
    },
    methods:{
        dateConvert(date) {
            let newDate = new Date(date)
            let myDate = {}
            myDate.date = newDate.toString().substring(0, 10)
            myDate.time = newDate.toString().substring(16, 24)
            return myDate
        },
    }
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout class="bg-myDark-300">
        <template v-slot:nav>
            <Navigation class="" />
        </template>
        <section class="mx-auto my-8 max-w-[1180px]">
            <div class="grid grid-cols-[1fr,1.8fr] gap-x-12">
                <div class="rounded-xl overflow-hidden w-[100%] h-[400px]">
                    <img :src="nft.imgurl" alt="" class="w-[100%] h-[100%]"/>
                </div>
                <div class="flex flex-col">
                    <div class="text-5xl font-bold uppercase mb-2 flex flex-col /items-center /justify-between">
                        <span class="text-xs uppercase px-4 py-1 mb-2 rounded-full bg-myGray w-fit">
                            {{ nft.blockchain }}
                        </span>
                        <span>
                            {{ nft.name }}
                        </span>
                    </div>
                    <!-- <p>{{ nft.description }}</p> -->
                    <p class="lg:w-[85%] mb-5 text-myGray">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Veniam, inventore rem, expedita sapiente quas culpa
                        tempora nisi, labore iste repellendus beatae odio. Neque
                        eligendi harum ad beatae, odit nobis quo!
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="uppercase font-bold text-2xl">
                            {{ nft.price }} {{ nft.blockchain.substring(0,3) }}
                        </div>

                        <div class="text-lg">
                        <span>Drops On: </span>
                        <span class="font-bold">{{ dateConvert(nft.dropdate).date }}</span>
                    </div>

                        <!-- <div class="flex items-center gap-x-3 text-2xl">
                            <span v-if="nft.website" class="">
                                <a :href="nft.website" target="_blank" class="hover:text-white w-6 block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></circle><line x1="37.5" y1="96" x2="218.5" y2="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line><line x1="37.5" y1="160" x2="218.5" y2="160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></line><ellipse cx="128" cy="128" rx="40" ry="93.4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></ellipse></svg>
                                </a>
                            </span>
                            <span v-if="nft.twitter" class="">
                                <a :href="nft.twitter" target="_blank" class="hover:text-white w-6 block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M128,88c0-22,18.5-40.3,40.5-40a40,40,0,0,1,36.2,24H240l-32.3,32.3A127.9,127.9,0,0,1,80,224c-32,0-40-12-40-12s32-12,48-36c0,0-64-32-48-120,0,0,40,40,88,48Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path></svg>
                                </a>
                            </span>
                            <span v-if="nft.discord" class="">
                                <a :href="nft.discord" target="_blank" class="hover:text-white w-6 block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="96" cy="144" r="8"></circle><circle cx="160" cy="144" r="8"></circle><path d="M74.4,80A174.9,174.9,0,0,1,128,72a174.9,174.9,0,0,1,53.6,8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><path d="M181.6,176a174.9,174.9,0,0,1-53.6,8,174.9,174.9,0,0,1-53.6-8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><path d="M155,182.1l12.1,24a7.8,7.8,0,0,0,9,4.2c24.5-6,45.7-16.4,61.1-29.8a8.1,8.1,0,0,0,2.4-8.4L205.7,58.9a7.7,7.7,0,0,0-4.7-5.1,176.4,176.4,0,0,0-29.6-9.2,8.1,8.1,0,0,0-9.4,5.3l-7.9,23.9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path><path d="M101,182.1l-12.1,24a7.8,7.8,0,0,1-9,4.2c-24.5-6-45.7-16.4-61.1-29.8a8.1,8.1,0,0,1-2.4-8.4L50.3,58.9A7.7,7.7,0,0,1,55,53.8a176.4,176.4,0,0,1,29.6-9.2A8.1,8.1,0,0,1,94,49.9l7.9,23.9" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8"></path></svg>
                                </a>
                            </span>
                        </div> -->
                    </div>
                    
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
