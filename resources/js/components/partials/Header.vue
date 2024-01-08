<template>
    <div class=" w-full absolute top-0  md:border  left-0 p-4 z-20 backdrop-blur-xl" :class="{'bg-white':theme != 'dark'}">
        <div class=" w-full  items-center justify-between  md:hidden flex">
            <div>
                <router-link to="/profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 md:text-primary" :class="{' text-white':theme == 'dark','text-primary':theme == 'password'}">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                </router-link>
            </div>
           
            <div class=" max-w-[14rem]">
                 <router-link to="/" class=" text-primary text-sm font-Altivo">
                   <img src="/images/LOGO_BLUE.png" class=" w-full object-cover" alt="logo blue" v-if="theme != 'dark'">
                   <img src="/images/LOGO_WHITE.png" class=" w-full object-cover" alt="logo white" v-else>
                 </router-link>
            </div>

            <button @click="openMenu">
                <svg v-if="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 md:text-primary" :class="{' text-white':theme == 'dark','text-primary':theme == 'password'}">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 md:text-primary" :class="{' text-white':theme == 'dark','text-primary':theme == 'password'}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                 </svg>


            </button>
        </div>

        <div class=" md:flex items-center justify-between hidden">
            <div class=" flex items-center space-x-8 text-primary font-Altivo text-lg">
                 <router-link to="/" class=" text-primary text-sm font-Altivo">
                     <img src="/images/LOGO_BLUE.png" class=" max-w-[12rem] object-cover" alt="logo blue">
                 </router-link>
                    <router-link to="/profile">MEIN KONTO</router-link>
                    <router-link to="/">KONTAKT</router-link>
                    <router-link to="/">HILFE</router-link>
                    <router-link to="/">SHOP</router-link>
            </div>
             <div>
             <div class=" flex items-center space-x-2">
                   <router-link to="/profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 md:text-primary" :class="{' text-white':theme == 'dark'}">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                </router-link>
                 <button @click="logOut" v-if="store.user.email" class="  text-primary  flex hover:scale-y-110 duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 m-auto  h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                </button>
             </div>
            </div>
        </div>

        
    </div>

   
</template>


<script setup>
 import { defineEmits, ref } from "vue";
 import { useStore } from "@/stores/states.js"
 const props = defineProps(['theme'])
 const open = ref(false)
  

 const store = useStore()
 import axios from 'axios'
 const emit = defineEmits('openMenu')
 const openMenu = () =>{
    open.value = !open.value
    emit('openMenu')
 }

  const logOut = () => {
    axios.post('/logout').then((res) => {
        localStorage.removeItem('token');
        // Reset the axios Authorization header:
        axios.defaults.headers.common['Authorization'] = 'Bearer';
        store.user = [];
        // Redirect the user to the login page:
        window.location.href = '/'
    }).catch((err) => {
        window.location.href = '/'
    })
  }
</script>