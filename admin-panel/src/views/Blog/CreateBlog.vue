<script setup>
import { onMounted } from "vue";
import AdminLayout from "../../components/AdminLayout.vue";
import BlogPost from "./BlogPost.vue";
import { usePostStore } from "../../stores/post";
import { useRouter } from "vue-router";

const store = usePostStore();
const router = useRouter();

async function createBlog(post) {
    // const form = new FormData();
    // const keys = Object.keys(post);
    // keys.forEach((key) => {
    //     if (Array.isArray(post[key])) {
    //         post[key].forEach((item, index) => {
    //             form.append(`${key}[${index}]`, item);
    //         });
    //     } else {
    //         form.append(key, post[key]);
    //     }
    // });

    store
        .create(post)
        .then((response) => {
            console.log(response);
            router.push({ name: "post.list" });
        })
        .catch((response) => {
            console.log(response);
        });
}

onMounted(() => {
    store.getPosts();
});
</script>

<template>
    <AdminLayout class="">
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-gray-600 items-center">
                Create Blog
            </h1>
        </div>
        <BlogPost @action="createBlog" action-type="Create"></BlogPost>
    </AdminLayout>
</template>
