<template>
    <div>
        <AnimatedCounter :duration="duration" :value="value" class="class"/>
    </div>
</template>

<script>

import AnimatedCounter from "vue-animated-counter";

export default {
    name: "circleCounterComponent.vue",
    components: {AnimatedCounter},
    data() {
        return {}
    },
    props: {
        class: {
            type: String,
            default: ''
        },
        duration: {
            type: Number,
            default: 15
        },
        value: {
            type: Number,
            default: 100
        },
    },
    methods: {}
}
</script>
