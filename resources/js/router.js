import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);


import Home from "./views/home.vue";
import User from "./views/user.vue";
import Project from "./views/project.vue";

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/user',
        component: User
    },
    {
        path: '/project',
        component: Project
    }
];

export default new VueRouter({
    mode:'history',
    routes
});