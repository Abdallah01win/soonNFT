<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
<script>
import Navigation from '@/Components/Navigation.vue'
    export default{
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
        </template>
    </AuthenticatedLayout>
</template>
