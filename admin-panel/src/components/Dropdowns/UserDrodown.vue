<script setup>
    import {createPopper} from '@popperjs/core'
    import { ref } from 'vue';
    import {useUserStore} from '../../stores/user'
    import {useRouter} from 'vue-router'

    import image from '../../assets/img/team-1-800x800.jpg'

    const user = useUserStore()
    const router = useRouter()

    const dropdownPopoverShow = ref(false)
    const img = image

    const btnDropdown = ref(null)
    const popoverDropdown = ref(null)



   function toggleDropdown() {
    if(dropdownPopoverShow.value) {
        dropdownPopoverShow.value = false
    } else {
        dropdownPopoverShow.value = true
        createPopper(btnDropdown.value, popoverDropdown.value, {
            placement: 'bottom-start'
        })
    }
   }

   const logout = () => {
    user.logout().then(() => {
        router.push({name: 'login'})
    })
   }



</script>

<template>
    <div>
      <a
        class="text-slate-500 block"
        href="#pablo"
        ref="btnDropdown"
        @click.prevent="toggleDropdown"
      >
        <div class="items-center flex">
          <span
            class="w-12 h-12 text-sm text-white bg-slate-200 inline-flex items-center justify-center rounded-full"
          >
            <img
              alt="..."
              class="w-full rounded-full align-middle border-none shadow-lg"
              :src="img"
            />
          </span>
        </div>
      </a>
      <div
        ref="popoverDropdown"
        class="bg-white text-base  z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
        v-bind:class="{
          hidden: !dropdownPopoverShow,
          block: dropdownPopoverShow,
        }"
      >
        <a
          href="javascript:void(0);"
          class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"
        >
          Action
        </a>
        <a
          href="javascript:void(0);"
          class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"
        >
          Another action
        </a>
        <a
          href="javascript:void(0);"
          class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"
        >
          Something else here
        </a>
        <div class="h-0 my-2 border border-solid border-slate-100" />
        <a
          
          class="text-sm py-2 px-4 mx-2 font-normal block w-auto rounded-lg text-center whitespace-nowrap bg-red-400 text-white"
          @click="logout"
        >
          Logout
        </a>
      </div>
    </div>
  </template>