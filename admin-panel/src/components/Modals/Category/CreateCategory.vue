<script setup>
// modal
import { ref, reactive, watch } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

// create category
import { useCategoryStore } from "../../../stores/category";
const default_value = {
    name: "",
    slug: "",
};
const category = reactive({ ...default_value });
const errors = ref({ ...default_value });

const store = useCategoryStore();

const create = () => {
    store
        .create({
            name: category.name,
            slug: category.slug,
        })
        .then(() => {
            store.getCategories();
            closeModal();
        })
        .catch(({ response: { data } }) => {
            errors.value.name =
                "name" in data.errors ? data.errors.name[0] : "";
            errors.value.slug =
                "slug" in data.errors ? data.errors.slug[0] : "";
        });
};

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
    category.name = "";
    category.slug = "";
    errors.value = { ...default_value };
}
function openModal() {
    isOpen.value = true;
}

watch(
    () => category.name,
    (newName) => {
        category.slug = newName
            .toLowerCase()
            .replace(/[^a-z0-9]/g, "-")
            .replace(/-+/g, "-") // Replace consecutive hyphens with a single hyphen
            .replace(/^-+|-+$/g, ""); // Remove leading/trailing hyphens
    }
);
</script>

<template>
    <div class="">
        <button
            type="button"
            @click="openModal"
            class="rounded-md bg-green-700 px-4 py-2 text-xl font-medium text-white hover:bg-black/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
        >
            Create
        </button>
    </div>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h1"
                                class="text-lg font-semibold leading-6 text-gray-900 text-center mb-5"
                            >
                                Create Category
                            </DialogTitle>
                            <hr />
                            <div class="mt-3">
                                <form>
                                    <div class="mb-6">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900 mb-2"
                                            >Category Name
                                        </label>
                                        <input
                                            type="text"
                                            class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            id="name"
                                            v-model="category.name"
                                            placeholder="Category Name"
                                        />
                                        <div class="text-red-400">
                                            {{ errors.name }}
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <label
                                            for="slug"
                                            class="block text-sm font-medium leading-6 text-gray-900 mb-2"
                                            >Category Slug
                                        </label>
                                        <input
                                            type="text"
                                            class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            id="slug"
                                            v-model="category.slug"
                                            placeholder="Slug"
                                        />
                                        <div class="text-red-400">
                                            {{ errors.slug }}
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <button
                                            type="button"
                                            class="mr-3 justify-center rounded-md border border-transparent bg-red-500 px-6 py-2 text-sm font-medium text-white hover:bg-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                            @click="closeModal"
                                        >
                                            Cancel
                                        </button>
                                        <button
                                            type="button"
                                            class="justify-center rounded-md border border-transparent bg-green-600 px-6 py-2 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                            @click="create"
                                        >
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
