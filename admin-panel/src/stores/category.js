import axios from 'axios'
import {defineStore} from 'pinia'
import {computed, ref} from 'vue'


export const useCategoryStore = defineStore('category', () =>  {
    const categories = ref([])

    async function getCategories() {
        // axios.get('/category/list').then(({data}) => {
        //     categories.value = data.categories
        //     console.log(data)
        // })
        const {data} = await axios.get('/category/list')
        categories.value = data.categories
    }

    function create(category) {

        return axios.post('/category/create', category)
    }

    function edit(category, id) {

        return axios.post(`/category/edit/${id}`, category)
    }
    
    function deleteCategory(category) {
        return axios.get(`/category/delete/${category}`)
    }

    return {categories, getCategories, create, edit, deleteCategory}
})