import axios from "axios";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useCategoryStore = defineStore("category", () => {
    const categories = ref([]);

    async function getCategories() {
        // axios.get('/category/list').then(({data}) => {
        //     categories.value = data.categories
        //     console.log(data)
        // })
        const { data } = await axios.get("/categories");
        categories.value = data.categories;
    }

    function create(category) {
        return axios.post("/categories", category);
    }

    function edit(category, id) {
        return axios.put(`/categories/${id}`, category);
    }

    function deleteCategory(category) {
        return axios.delete(`/categories/${category}`);
    }

    return { categories, getCategories, create, edit, deleteCategory };
});
