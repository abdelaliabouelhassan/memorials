<template>
  <div class=" w-full h-screen overflow-hidden  relative ">
   <div class=" w-full max-w-lg sm:border-2 h-full max-h-full mx-auto relative">
     <Header @openMenu='openMenu' :theme='theme' /> 
     <div class=" w-full h-full pt-[3.2rem]  relative" :class="{'pb-20':theme != 'dark'}">
       <div class=" w-full absolute backdrop-blur-md  h-full z-50 left-0 " v-if="open">
          <div class=" w-full py-10 px-8 flex flex-col items-end space-y-2 justify-end text-primary text-2xl font-Altivo font-normal">
            <router-link to="/profile">MEIN KONTO</router-link>
            <router-link to="/">KONTAKT</router-link>
            <router-link to="/">HILFE</router-link>
            <router-link to="/">SHOP</router-link>
            <div class=" pt-5 flex flex-col justify-end items-end">
            <router-link to="/" class=" text-base">PRIVACY POLICY</router-link>
            <router-link to="/" class=" text-base">IMPRINT</router-link>
            </div>
           
          </div>
       </div>
       <div class=" w-full h-full  overflow-y-auto">
         <slot />
      </div>
     </div>
     <Footer v-if="theme != 'dark'" />
   </div>
  </div>
</template>

<script setup>
 import Header from '@/components/partials/Header.vue'
 import Footer from '@/components/partials/Footer.vue'
 import { ref } from 'vue'
 
 const props = defineProps(['theme'])

 const open = ref(false)
  const openMenu = () => {
    open.value = !open.value
  }
</script>