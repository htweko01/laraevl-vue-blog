<script setup>
import { onMounted } from "vue";
import AdminLayout from "../../components/AdminLayout.vue";
import BlogPost from "./BlogPost.vue";
import { usePostStore } from "../../stores/post";
import { useRouter, useRoute } from "vue-router";
const store = usePostStore();
const router = useRouter();
const route = useRoute();
</script>

<template>
    <AdminLayout class="">
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-gray-600 items-center">
                Edit Blog
            </h1>
        </div>
        <BlogPost action-type="Edit" :post-slug="route.params.slug"></BlogPost>
    </AdminLayout>
</template>
