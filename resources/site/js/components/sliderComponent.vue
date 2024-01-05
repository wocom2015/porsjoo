<template>

    <div>
        <carousel :autoplay="1" :items-to-show="4.1" :transition="5000" :wrap-around="true">
            <slide v-for="slide in slides" :key="slide">
                <img :src="slide.url" height="250" width="250"/>
            </slide>

            <template #addons>
                <navigation/>
                <pagination/>
            </template>
        </carousel>
    </div>

</template>

<script>
import 'vue3-carousel/dist/carousel.css'
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel'

export default {
    name: "sliderComponent.vue",
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    props: ['slides'],
    data() {
        return {}
    },
    methods: {},
    mounted() {
    }

}
</script>

<style scoped>
.carousel__slide {
    margin: 5px 10px;
}
</style>
