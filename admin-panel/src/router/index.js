import {createRouter, createWebHistory} from 'vue-router'
import { useUserStore } from '../stores/user'

import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import Unauthorized from '../views/Unauthorized.vue'
import CategoryList from '../views/category/CategoryList.vue'


const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {requireAuth: false}
    },
    {
        path: '/register',
        name: '/register',
        component: Register,
        meta: {requireAuth: false}
    },
    {
        path: '/unauthorized',
        name: 'unauthorized',
        component: Unauthorized,
        meta: {requireAuth: true}
    },
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {requireAuth: true}
    },
    {
        path: '/categories',
        name: 'category.list',
        component: CategoryList,
        meta: {requireAuth: true}
    }
    
    
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from) => {
    const userStore = useUserStore()
    if(!userStore.user.token && to.meta.requireAuth) {
        return {name: 'login'}
    }
})



export default router