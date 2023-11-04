import { createApp } from 'vue'
import './index.css'
import App from './App.vue' 
import router from './router'
import { createPinia } from 'pinia'
import axios from 'axios'


const pinia = createPinia()
const app = createApp(App)

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
app.use(router)
    .use(pinia)
    .mount('#app')
