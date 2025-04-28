import { createRouter,createWebHistory } from "vue-router";
import Dashboard from '../views/Dashboard.vue';
import Login from '../views/Login.vue';

const routes = [
    {
        path:'/dashboard',
        name:'dashboard',
        component: () => import('../views/Dashboard.vue'),
    },
    {
       path:'/login',
       name:'login',
       component: () => import('../views/Login.vue'),
    },
    {
     path:'/request-password',
     name:'requestPassword',
     component: () => import('../views/RequestPassword.vue'),
    },
    {
     path:'/reset-password/:token',
     name:'resetPassword',
     component: () => import('../views/ResetPassword.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;