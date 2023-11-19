<script setup>
import Navbar from "./Navbars/Navbar.vue";
import Sidebar from "./Sidebar/Sidebar.vue";
</script>

<template>
    <div>
        <Sidebar />
        <div class="relative md:ml-64 bg-blueGray-100">
            <Navbar />
            <div class="relative bg-slate-200-600 p-2"></div>

            <div
                class="px-4 md:px-10 mx-auto w-full bg-gray-100 min-h-screen pt-5 pb-10"
            >
                <slot></slot>
            </div>
        </div>
    </div>
</template>
