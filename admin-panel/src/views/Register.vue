<script setup>
  import { ref } from 'vue';
  import { useUserStore } from '../stores/user';
  import router from '../router';

  const user = useUserStore();
  const errorMsg = ref('')

  const formData = {
    name: null, 
    email: null,
    password: null,
    password_confirmation: null
  }

  function register() {
    user.register(formData).then(() => {
      router.push({name: 'dashboard'})   
    }).catch(({response}) => {
      errorMsg.value = response.data.message
    })
  }

</script>

<template>
    <div class="container mx-auto px-4 h-screen">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4">
          <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-200 border-0"
          >
            <div class="rounded-t mb-0 px-6 py-6">
              <div class="text-center mb-3">
                <h6 class="text-slate-500 text-sm font-bold">
                  Sign up 
                </h6>
              </div>
            
              <hr class="mt-6 border-b-1 border-slate-300" />
              <div class="text-center text-red-600">{{ errorMsg }}</div>
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              
              <form @submit.prevent="register">
                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-slate-600 text-xs font-bold mb-2"
                    htmlFor="name"
                  >
                    Name
                  </label>
                  <input
                    type="text"
                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    placeholder="Name"
                    id="name"
                    v-model="formData.name"
                  />
                </div>
  
                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-slate-600 text-xs font-bold mb-2"
                    htmlFor="email"
                  >
                    Email
                  </label>
                  <input
                    type="email"
                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    placeholder="Email"
                    id="email"
                    v-model="formData.email"
                  />
                </div>
                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-slate-600 text-xs font-bold mb-2"
                    htmlFor="password"
                  >
                    Password
                  </label>
                  <input
                    type="password"
                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    placeholder="Password"
                    id="password"
                    v-model="formData.password"
                  />
                </div>

                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-slate-600 text-xs font-bold mb-2"
                    htmlFor="password_comfirm"
                  >
                    Confirm Password
                  </label>
                  <input
                    type="password"
                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    placeholder="Confirm Password"
                    id="password_confirm"
                    v-model="formData.password_confirmation"
                  />
                </div>
  
                
                <!-- <div>
                  <label class="inline-flex items-center cursor-pointer">
                    <input
                      id="customCheckLogin"
                      type="checkbox"
                      class="form-checkbox border-0 rounded text-slate-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                    />
                    <span class="ml-2 text-sm font-semibold text-slate-600">
                      I agree with the
                      <a href="javascript:void(0)" class="text-emerald-500">
                        Privacy Policy
                      </a>
                    </span>
                  </label>
                </div>
   -->
                <div class="text-center mt-6">
                  <button
                    class="bg-slate-800 text-white active:bg-slate-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                    
                  >
                    Create Account
                  </button>
                </div>
                <div class="mt-4 text-slate-500">
                    <router-link to="/login">Already have an account?</router-link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>