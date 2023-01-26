<script>
import { Head } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';

export default {
    components:{
        Head,
        Navigation,
        Footer,
    }
}
</script>
<template>
    <Head title="Blog" />
    <Navigation />
    <h1>Blog</h1>

    <Footer />
</template>