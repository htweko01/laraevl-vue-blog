import {defineStore} from 'pinia'
import { computed, ref } from 'vue'
import axios from 'axios';

export const useUserStore = defineStore('user', () => {
    // const user = {};
    // const token = localStorage.getItem('token');
    const user = ref({
        data: {},
        token: localStorage.getItem('token')
    })

    function getCurrentUser() {
        if(!user.value.token) return
        axios.get('/user').then(({data}) => {
            setUser(data)
        }).catch(e => {
            console.log(e)
        })
    }

    function setToken(value) {
        user.value.token = value
        if(value) {
            localStorage.setItem('token', value)
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
        } else {
            localStorage.removeItem('token')

        }
    }

    function setUser(value) {
        user.value.data = value
    }

    function register(form) {
        console.log(form)
        return axios.post('/register', form).then(({data}) => {
            if(data.user && data.token) {
                setUser(data.user)
                setToken(data.token)
            }
        })
    }

    function login(form) {
        return axios.post('/login', form).then(({data}) => {
            setUser(data.user)
            setToken(data.token)
        })
    }

    function logout() {
        return axios.post('/logout').then(() => {
            setUser(null)
            setToken(null)
        })
        

    }

    if(Object.keys(user.value.data).length == 0 && user.value.token) getCurrentUser()

    return {user, getCurrentUser, login, logout, register, setToken, setUser, }
})