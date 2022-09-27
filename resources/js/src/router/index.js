

import {createRouter, createWebHistory}  from 'vue-router'
import * as path from "path";

const routes = [
    {
        path:'/',
        name:"Login",
        isProtected:false,
        component:()=>import( '../Auth/Login.vue')
    }
    ,
    {
        path:'/register',
        name:"Register",
        isProtected:false,
        component:()=>import('../Auth/Register.vue')
    },
    {
        path:'/home',
        name:"Home",
        component:()=>import('../Pages/Home.vue'),
        meta: {
            requiresAuth: true
        }
    }
]

const protectedRoutes = ['Home']

const router = createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    let isAuthenticated = localStorage.getItem("access_token") || null
    if (protectedRoutes.includes(to.name)) {
        if (!isAuthenticated) {
            next({
                path: '/',
            })
        }
    }
    if (to.name === 'Register'  || to.name === 'Login') {
        if (isAuthenticated) {
            next('/home');
        }
    }
    next();
});


export default router
