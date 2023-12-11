import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const usePostStore = defineStore("post", () => {
    const posts = ref([]);

    async function getPosts() {
        const { data } = await axios.get("/posts");
        posts.value = data;
    }

    function create(post) {
        const config = {
            headers: {
                "content-type": "multipart/form-data",
            },
        };
        return axios.post("/posts", post, config);
    }

    function deletePost(post) {
        return axios.delete(`/posts/${post}`);
    }

    return { getPosts, posts, create, deletePost };
});
