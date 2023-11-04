<script setup>
import { useUserStore } from '../stores/user';
const user = useUserStore()
// console.log(user.getUser)
user.getUser
</script>

<template>
    <h1 class="text-red-600">UnAuthorized</h1>
</template>