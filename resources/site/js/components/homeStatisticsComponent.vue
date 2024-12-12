<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 text-center">
                <circle-counter-component :value="entity.statistics_industries" class="counter" duration="10"/>
            </div>
            <div class="col-6 text-center">
                <circle-counter-component :value="entity.statistics_customers" class="counter" duration="10"/>
            </div>
        </div>
        <div class="row pt-10 pb-10 mt-10 mb-10">
            <div class="col-6 text-center">
                تنوع صنایع
            </div>
            <div class="col-6 text-center">
                تعداد مشتریان
            </div>
        </div>
        <div class="row" style="padding:20px 0 20px 0">
        </div>
        <div class="row pt-10 pb-10 mt-10 mb-10">
            <div class="col-6 text-center">
                <circle-counter-component :value="entity.statistics_inquiries" class="counter" duration="10"/>
            </div>
            <div class="col-6 text-center">
                <circle-counter-component :value="entity.statistics_success_industries" class="counter" duration="10"/>
            </div>
        </div>
        <div class="row pt-10 pb-10 mt-10 mb-10">
            <div class="col-6 text-center">
                کل استعلام ها
            </div>
            <div class="col-6 text-center">
                استعلام های موفق
            </div>
        </div>
    </div>
</template>

<script>


import circleCounterComponent from "./circleCounterComponent.vue";

export default {
    name: "homeStatisticsComponent.vue",
    props: ['entity'],
    components: {circleCounterComponent},
    data() {
        return {}
    },
    computed: {},
    methods: {},
    mounted() {
    }

}
</script>
