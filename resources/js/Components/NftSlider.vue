<script setup>
import axios from "axios";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import '@splidejs/vue-splide/css';
import NftCard from "./NftCard.vue";
</script>
<script>
export default {
    props: {
        dataRoute: String,
        nftId: '',
    },
    data() {
        return {
            NftData: Object,
        }
    },
    components: {
        Splide,
        SplideSlide,
    },
    computed: {
        /* removeCurrentNft(){
             if(this.nftId !== ''){
             return  this.NftData.filter(nft => nft.id !== this.nftId)
             } else {
                 return this.NftData;
             }
         }*/
    },
    methods: {
        getData(route) {
            axios
                .get(route)
                .then((response) => (this.NftData = response.data));
        },
    },
    mounted() {
        this.getData(this.dataRoute);
    },
}
</script>

<template>
    <Splide :options="{
        rewind: true,
        autoWidth: true,
        focus: 'center',
        perPage: 4,
        perMove: 2,
        gap: '2em',
        padding: '4rem',
    }" :classes="{
    pagination: 'splide__pagination no-pagination',
}" aria-label="Viral Nfts">
        <SplideSlide v-for="item in NftData" :key="item.id">
            <NftCard :item="item" />
        </SplideSlide>
    </Splide>
</template>