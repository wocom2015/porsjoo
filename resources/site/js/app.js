/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler';
import searchComponent from './components/searchComponent.vue';
import dateComponent from './components/dateComponent.vue';
import inquiryComponent from './components/inquiryComponent.vue';
import inquiryListComponent from './components/inquiryListComponent.vue';
import inquirySentComponent from './components/inquirySentComponent.vue';
import subComponent from './components/subMenuComponent.vue';
import sliderComponent from './components/sliderComponent.vue';
import feedbackComponent from './components/feedbackComponent.vue';
import jQuery from 'jquery';

window.$ = jQuery;
const app = createApp({
    components: {
        searchComponent,
        dateComponent,
        inquiryComponent,
        inquiryListComponent,
        inquirySentComponent,
        subComponent,
        sliderComponent,
        feedbackComponent,
    }
});
app.mount('#app');
//app.component('DatePicker', Vue3PersianDatetimePicker)






