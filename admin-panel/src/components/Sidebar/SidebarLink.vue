<script setup>
const props = defineProps(["uri", "name" , 'icon']);
</script>

<template>
    <router-link :to="uri" v-slot="{ href, navigate, isActive }">
        <a
            :href="href"
            @click="navigate"
            class="text-xs uppercase py-3 font-bold block"
            :class="[
                isActive
                    ? 'text-emerald-500 hover:text-emerald-600'
                    : 'text-slate-700 hover:text-slate-500',
            ]"
        >
            <i
                class="mr-2 text-sm"
                :class="[isActive ? 'opacity-75' : 'text-slate-300', icon]"
            ></i>
            {{ name }}
        </a>
    </router-link>
</template>
