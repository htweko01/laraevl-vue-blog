<script setup>
import AdminLayout from "../../components/AdminLayout.vue";
import BlogPost from "./BlogPost.vue";
</script>

<template>
    <AdminLayout class="">
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-gray-600 items-center">
                Create Blog
            </h1>
        </div>
        <BlogPost></BlogPost>
    </AdminLayout>
</template>
