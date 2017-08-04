import './bootstrap';
import Vue from 'vue';
import Posts from './components/Posts.vue';
import VueApp from './components/VueApp.vue';
import router from './router';

const app = new Vue({
    el: '#app',
    components: {
        Posts,
        VueApp
    },
    router
});
