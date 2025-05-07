import store from "@/store";
import { createRouter,createWebHistory } from "vue-router";
const routes = [
    {
        path: '/app',
        name: 'app',
        component: () => import('../components/AppLayout.vue'),
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path:'dashboard',
                name:'app.dashboard',
                component: () => import('../views/Dashboard.vue'),
            }
            ,{
                path: 'products',
                name: 'app.products',
                component: () => import('../views/Products/Product.vue'), 
              },
        ]
    }
   ,
    {
       path:'/login',
       name:'login',
       meta: {
        requerGuest: true,
       },
       component: () => import('../views/Login.vue'),
    },
    {
     path:'/request-password',
     name:'requestPassword',
     meta: {
        requerGuest: true,
       },
     component: () => import('../views/RequestPassword.vue'),
    },
    {
     path:'/reset-password/:token',
     name:'resetPassword',
     meta: {
        requerGuest: true,
       },
     component: () => import('../views/ResetPassword.vue'),
    },
    ,
    {
     path:'/:pathMatch(.*)*',
        name:'notFound',
        component: () => import('../views/NotFound.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth && !store.state.user.token) {
        next({ name: 'login' });
    }else if(to.meta.requerGuest && store.state.user.token) {
        next({ name: 'app.dashboard' });
    }else {         
        next();
    }
}) 

export default router;