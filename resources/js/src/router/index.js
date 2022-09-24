

import {createRouter, createWebHistory}  from 'vue-router'

const routes = [
    {
        path:'/',
        name:"Login",
        component:()=>import( '../Auth/Login.vue')
    }
    ,
    {
        path:'/register',
        name:"Register",
        component:()=>import('../Auth/Register.vue')
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router
