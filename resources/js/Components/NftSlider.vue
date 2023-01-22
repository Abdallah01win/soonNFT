<script setup>
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import '@splidejs/vue-splide/css';
import NftCard from "./NftCard.vue";
</script>
<script>
export default {
    props: {
        drops: Object,
        nftId: '',
    },
    data() {
        return {
        }
    },
    components: {
        Splide,
        SplideSlide,
        NftCard,
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
        <SplideSlide v-for="item in drops" :key="item.id">
            <NftCard :item="item" />
        </SplideSlide>
    </Splide>
</template>

<style>
.splide__arrow{
    background: #5e45ff !important;
}
</style>