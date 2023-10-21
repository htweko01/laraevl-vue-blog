import {createRouter, createWebHistory} from 'vue-router'

import Login from '../views/Login.vue'
import Register from '../views/Register.vue'

import Dashboard from '../views/Dashboard.vue'


const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {requiresAuth: false}
    },
    {
        path: '/register',
        name: '/register',
        component: Register,
        meta: {requiresAuth: false}

    },
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {requiresAuth: true},
    },
    
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth) {
        return {name: 'login'}
    }
})



export default router