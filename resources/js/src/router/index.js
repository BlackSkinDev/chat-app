

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
        isProtected:true,
        component:()=>import('../Pages/Home.vue')
    }
]

const protectedRoutes = ['Home']

const router = createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    let isAuthenticated = localStorage.getItem("access_token")
    if (protectedRoutes.includes(to.name)) {
        if (!isAuthenticated) {
            next({
                path: '/',
                query: {
                    access:'denied',
                }
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
