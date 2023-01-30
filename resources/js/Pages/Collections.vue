<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';
export default{
    props: {
        cols: Object
    },
    components:{
        Navigation,
        Footer,
    }
}
</script>
<template>
    <Head title="Home" />
    <Navigation />
    {{ cols }}
    <Footer />
</template>