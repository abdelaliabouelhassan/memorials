<template>
    <div class=" w-full absolute top-0  left-0 p-4 z-20 backdrop-blur-xl" :class="{'bg-white':theme != 'dark'}">
        <div class=" w-full flex items-center justify-between">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 text-primary" :class="{' text-white':theme == 'dark'}">
                   <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class=" max-w-[14rem]">
                 <router-link to="/" class=" text-primary text-sm font-Altivo">
                   <img src="/images/LOGO_BLUE.png" class=" w-full object-cover" alt="logo blue" v-if="theme != 'dark'">
                   <img src="/images/LOGO_WHITE.png" class=" w-full object-cover" alt="logo white" v-else>
                 </router-link>
            </div>

            <button @click="openMenu">
                <svg v-if="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-primary" :class="{' text-white':theme == 'dark'}">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-primary" :class="{' text-white':theme == 'dark'}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                 </svg>


            </button>
        </div>
    </div>

   
</template>


<script setup>
 import { defineEmits, ref } from "vue";
 const props = defineProps(['theme'])
 const open = ref(false)
 const emit = defineEmits('openMenu')
 const openMenu = () =>{
    open.value = !open.value
    emit('openMenu')
 }
</script>