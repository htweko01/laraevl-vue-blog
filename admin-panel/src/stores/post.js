import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const usePostStore = defineStore("post", () => {
    const posts = ref([]);

    async function getPosts() {
        const { data } = await axios.get("/posts");
        posts.value = data.data;
    }

    function getPost(slug) {
        return axios.get(`posts/${slug}`);
    }

    function create(post) {
        const config = {
            headers: {
                "content-type": "multipart/form-data",
            },
        };

        return axios.post("/posts", post, config);
    }

    function editPost(post, id) {
        const config = {
            headers: {
                "content-type": "multipart/form-data",
            },
        };

        return axios.post(
            `/posts/${id}`,
            {
                ...post,
                _method: "put",
            },
            config
        );
    }

    function deletePost(post) {
        return axios.delete(`/posts/${post}`);
    }

    return { getPosts, getPost, editPost, posts, create, deletePost };
});
