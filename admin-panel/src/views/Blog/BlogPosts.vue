<script setup>
import { ref, onMounted } from "vue";
import AdminLayout from "../../components/AdminLayout.vue";
import DeleteModal from "../../components/Modals/DeleteModal.vue";

import { usePostStore } from "../../stores/post";
const store = usePostStore();

const deleteModal = ref(null);

function showDeleteModal(id) {
    deleteModal.value.open = true;
    deleteModal.value.id = id;
}

function deletePost(id) {
    store
        .deletePost(id)
        .then(() => {
            store.getPosts();
            deleteModal.value.open = false;
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
    <AdminLayout>
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-gray-600 items-center">
                Blog Posts
            </h1>
            <router-link to="/posts/create"
                ><span
                    class="rounded-md bg-blue-700 px-4 py-2 text-xl font-medium text-white hover:bg-black/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                >
                    Write Blog
                </span></router-link
            >
        </div>

        <!-- post table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div
                class="w-full text-lg text-center py-20"
                v-if="store.posts.length == 0"
            >
                No Post Found
            </div>
            <table
                v-else
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th class="px-3">ID</th>
                        <th scope="col" class="px-6 py-3">post name</th>
                        <th>Slug</th>
                        <th>Created By</th>
                        <th>Edited By</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b hover:bg-gray-50"
                        v-for="(post, index) in store.posts"
                        :key="index"
                    >
                        <td class="px-3">{{ post.id }}</td>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            {{ post.title }}
                        </th>
                        <td>
                            {{ post.slug }}
                        </td>
                        <td>{{ post.createdBy }}</td>
                        <td>{{ post.editedBy }}</td>
                        <td class="px-6 py-4 text-right">
                            <!-- <a
                                @click=""
                                class="mr-3 font-medium text-blue-600 hover:underline"
                                >Edit</a
                            > -->
                            <router-link
                                :to="{
                                    name: 'post.edit',
                                    params: { slug: post.slug },
                                }"
                                class="mr-3 font-medium text-blue-600 hover:underline"
                            >
                                Edit
                            </router-link>
                            <a
                                @click="showDeleteModal(post.id)"
                                class="font-medium text-red-600 hover:underline"
                                >Delete</a
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <DeleteModal
            ref="deleteModal"
            @delete="deletePost"
            type="Post"
        ></DeleteModal>
    </AdminLayout>
</template>
