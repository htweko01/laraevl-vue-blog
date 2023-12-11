<script setup>
import { ref, watch, onMounted } from "vue";
import AdminLayout from "../../components/AdminLayout.vue";
import Editor from "../../components/Inputs/Editor/Editor.vue";
import VueTailwindDatepicker from "vue-tailwind-datepicker";
import Multiselect from "@vueform/multiselect";

import { useCategoryStore } from "../../stores/category";

const categoryStore = useCategoryStore();

const props = defineProps({
    post: Object,
    actionType: String,
});

const emit = defineEmits(["action"]);

const categories = ref({});

const post = ref({
    title: null,
    slug: null,
    image: null,
    body: null,
    categories: null,
    publishedAt: "",
    active: false,
});

const previewImageURL = ref("");

function fileChange(event) {
    post.value.image = event.target.files[0];
    readFile(post.value.image).then((url) => {
        previewImageURL.value = url;
    });
}

// read image file
function readFile(file) {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            resolve(fileReader.result);
        };
        fileReader.onerror = reject;
    });
}

watch(
    () => post.value.title,
    (newTitle) => {
        post.value.slug = newTitle
            .toLowerCase()
            .replace(/[^a-z0-9]/g, "-")
            .replace(/-+/g, "-") // Replace consecutive hyphens with a single hyphen
            .replace(/^-+|-+$/g, ""); // Remove leading/trailing hyphens
    }
);

async function getCategoryOptions() {
    const data = await categoryStore.getCategories();
    data.forEach((item) => {
        categories.value[item.id] = item.name;
    });
}

// disable past date for date picker
function disableDate(date) {
    return date < new Date();
}

onMounted(() => {
    getCategoryOptions();
});
</script>

<template>
    <form @submit.prevent="$emit('action', post)" enctype="multipart/form-data">
        <div class="bg-white p-3 mx-auto rounded-md shadow-sm lg:w-11/12">
            <div class="lg:flex mb-6">
                <div class="mx-3 mb-3 basis-1/2">
                    <label
                        for="title"
                        class="block font-medium leading-6 text-gray-900 mb-3"
                    >
                        Blog Title</label
                    >
                    <input
                        type="text"
                        id="title"
                        class="block w-full rounded-md border-0 py-1.5 pl-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        v-model="post.title"
                    />
                </div>
                <div class="mx-3 mb-3 basis-1/2">
                    <label
                        for="slug"
                        class="block font-medium leading-6 text-gray-900 mb-3"
                    >
                        Blog Slug</label
                    >
                    <input
                        type="text"
                        id="slug"
                        class="block w-full rounded-md border-0 py-1.5 pl-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        v-model="post.slug"
                    />
                </div>
            </div>

            <div class="mx-3 my-6 basis-1/2">
                <label
                    for="published-at"
                    class="block font-medium leading-6 text-gray-900 mb-3"
                >
                    Categories</label
                >
                <Multiselect
                    v-model="post.categories"
                    :options="categories"
                    mode="tags"
                    :close-on-select="false"
                    :searchable="true"
                    :create-option="true"
                ></Multiselect>
            </div>

            <!-- Blog Body -->
            <div class="mx-3 mb-6">
                <label
                    for="body"
                    class="block font-medium leading-6 text-gray-900 mb-3"
                    >Body</label
                >
                <Editor v-model="post.body"></Editor>
            </div>

            <div class="mx-3 my-6 basis-1/2">
                <label
                    for="published-at"
                    class="block font-medium leading-6 text-gray-900 mb-3"
                >
                    Published At</label
                >
                <vue-tailwind-datepicker
                    v-model="post.publishedAt"
                    placeholder="Select Publish Date"
                    as-single
                    :formatter="{ date: 'YYYY-MM-DD', month: 'MMM' }"
                    :disable-date="disableDate"
                />
            </div>

            <div class="my-6 mx-3 basis-1/2">
                <label
                    for=""
                    class="block font-medium leading-6 text-gray-900 mb-3"
                    >Image</label
                >
                <div class="flex items-center justify-center">
                    <label
                        for="dropzone-file"
                        :class="{
                            'pt-5 pb-6 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600':
                                !previewImageURL,
                        }"
                    >
                        <img
                            v-if="previewImageURL"
                            :src="previewImageURL"
                            alt="Image"
                            class="h-full cursor-pointer"
                        />
                        <div
                            v-else
                            class="flex flex-col items-center justify-center"
                        >
                            <svg
                                class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 20 16"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                />
                            </svg>
                            <p
                                class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                            >
                                <span class="font-semibold"
                                    >Click to upload</span
                                >
                                or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PNG, JPG ,JPEG
                            </p>
                        </div>
                        <input
                            id="dropzone-file"
                            type="file"
                            class="hidden"
                            accept=".jpg, .png, .jpeg"
                            @change="fileChange"
                        />
                    </label>
                </div>
            </div>

            <div class="mx-3 mb-6">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input
                        type="checkbox"
                        v-model="post.active"
                        class="sr-only peer"
                    />
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                    ></div>
                    <span class="ms-3 text-sm font-medium text-gray-900"
                        >Active</span
                    >
                </label>
            </div>
            <div class="mb-6">
                <button
                    type="submit"
                    class="px-10 py-3 bg-green-600 text-white rounded-md"
                >
                    {{ actionType }}
                </button>
            </div>
        </div>
    </form>
</template>

<style>
@import "@vueform/multiselect/themes/tailwind.css";
</style>
