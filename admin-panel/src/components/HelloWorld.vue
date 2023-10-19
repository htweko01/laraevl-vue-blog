<script setup>
import { ref } from 'vue'

defineProps({
  msg: String,
})

const count = ref(0)
</script>

<template>
  <h1 class="bg-red-700">{{ msg }}</h1>
  <h2 class="bg-purple-600">Hello</h2>
  
</template>

<style scoped>
</style>
