<template>
    <date-picker v-model="date"></date-picker>
</template>

<script>
import DatePicker from 'vue3-persian-datetime-picker'
export default {
    data(){
        return {
            date: ''
        }
    },
    components: { DatePicker }
}
</script>
