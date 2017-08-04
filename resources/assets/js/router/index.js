import Vue from 'vue';
import Router from 'vue-router';
import Posts from '../components/Posts.vue'
Vue.use(Router);

export default new Router({
   routes: [
       {
           path: '/',
           name: 'Home',
           component: {
               template: `<div>Home - vue-app</div>`
           }
       },
       {
           path: '/users',
           name: 'Users',
           component: {
               template: `<div>Users Page</div>`
           }
       },
       {
           path: '/posts',
           name: 'Posts',
           component: Posts
       },
       {
           path: '/articles',
           name: 'Articles',
           component: {
               template: `<div>Articles</div>`
           }
       }
   ]
});