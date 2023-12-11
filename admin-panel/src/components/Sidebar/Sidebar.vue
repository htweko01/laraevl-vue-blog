<script setup>
import SidebarLink from "./SidebarLink.vue";
</script>

<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-slate-50 flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
    >
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
            <!-- Toggler -->
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button"
                v-on:click="toggleCollapseShow('bg-white m-2 py-3 px-6')"
            >
                <i class="fas fa-bars"></i>
            </button>
            <!-- Brand -->
            <router-link
                class="md:block text-left md:pb-2 text-slate-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                to="/"
            >
                LaraBlog
            </router-link>
            <!-- User -->

            <div
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
            >
                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-slate-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Admin Layout Pages
                </h6>
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <SidebarLink
                            uri="/"
                            icon="fas fa-tv mr-2"
                            name="Dashboard"
                        ></SidebarLink>
                    </li>
                    <li class="items-center">
                        <SidebarLink
                            uri="/categories"
                            name="Categories"
                            icon="fa-solid fa-folder-tree"
                        ></SidebarLink>
                    </li>
                    <li class="items-center">
                        <SidebarLink
                            uri="/posts"
                            name="Blog Post"
                            icon="fab fa-blogger-b"
                        ></SidebarLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
