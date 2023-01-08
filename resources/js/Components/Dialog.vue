<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>
<script>
export default {
    name: "Dialoge",
    components: {
        PrimaryButton,
        DropdownLink
    },
    props: {
        title: String,
        msg: String,
        id: String,
        itemId: Number,
    },
};
const close = (id) => {
    const formHolder = document.getElementById(id);
    formHolder.classList.toggle('hidden');
}
</script>
<template>
    <div class="bg-gray-700/50 absolute top-0 left-0 w-full h-screen z-10 hidden" :id="id">
        <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg px-10 py-8 w-[40%] mx-auto translate-y-[130%]">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-xl font-semibold">{{this.title}}</h3>
                <button class="p-2 bg-gray-200 rounded-full" @click="close(id)">
                   <span class="w-6">
                    <ion-icon name="close-outline"></ion-icon>
                   </span>
                </button>
            </div>
            <p>{{this.msg}}</p>
            <div class="flex items-center justify-end mt-6">

                <PrimaryButton type="button" class="ml-4" @click="close(id)">
                    Cancel
                </PrimaryButton>

                <DropdownLink :href="route('/')" method="post" as="button" :data="{id : itemId}"
                    class="ml-4 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase  tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 w-fit">Delete
                </DropdownLink>

            </div>
        </div>
    </div>
</template>