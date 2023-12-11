<script setup>
import { ref, onMounted } from "vue";
import AdminLayout from "../../components/AdminLayout.vue";
import CreateCategory from "../../components/Modals/Category/CreateCategory.vue";
// import DeleteCategory from "../../components/Modals/Category/DeleteCategory.vue";
import DeleteModal from "../../components/Modals/DeleteModal.vue";
import EditCategory from "../../components/Modals/Category/EditCategory.vue";

import { useCategoryStore } from "../../stores/category";

const store = useCategoryStore();
const deleteModal = ref(null);
const editModal = ref(null);

function showDeleteModal(id) {
    deleteModal.value.open = true;
    deleteModal.value.id = id;
}

function deleteCategory(id) {
    store.deleteCategory(id).then(() => {
        store.getCategories();
        deleteModal.value.open = false;
    });
}

function showEditModal({ id, name, slug }) {
    editModal.value.isOpen = true;
    editModal.value.category.name = name;
    editModal.value.category.slug = slug;
    editModal.value.category.id = id;
}

onMounted(() => {
    store.getCategories();
});
</script>

<template>
    <AdminLayout>
        <div class="flex justify-between mb-5">
            <h1 class="text-3xl font-bold text-gray-600 items-center">
                Categories
            </h1>
            <CreateCategory></CreateCategory>
        </div>

        <!-- category table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div
                class="w-full text-lg text-center py-20"
                v-if="store.categories.length == 0"
            >
                No Category Found
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
                        <th scope="col" class="px-6 py-3">Category name</th>
                        <th>Slug</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b hover:bg-gray-50"
                        v-for="(category, index) in store.categories"
                        :key="index"
                    >
                        <td class="px-3">{{ category.id }}</td>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            {{ category.name }}
                        </th>
                        <td>
                            {{ category.slug }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a
                                @click="showEditModal(category)"
                                class="mr-3 font-medium text-blue-600 hover:underline"
                                >Edit</a
                            >
                            <a
                                @click="showDeleteModal(category.id)"
                                class="font-medium text-red-600 hover:underline"
                                >Delete</a
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end category table -->
        <DeleteModal
            ref="deleteModal"
            @delete="deleteCategory"
            type="Category"
        ></DeleteModal>
        <EditCategory ref="editModal"></EditCategory>
    </AdminLayout>
</template>
