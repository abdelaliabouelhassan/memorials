<template>
  <div class=" w-full h-screen overflow-hidden  relative ">
   <div class=" w-full max-w-lg border-2 h-full max-h-full mx-auto space-y-4 relative">
     <Header @openMenu='openMenu' /> 
     <div class=" w-full h-full pt-16 pb-20 relative">
       <div class=" w-full absolute backdrop-blur-md  h-full z-10 left-0 " v-if="open">
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
       <div class=" w-full h-full py-4 px-4 overflow-y-auto">
         <slot />
      </div>
     </div>
     <Footer />
   </div>
  </div>
</template>

<script setup>
 import Header from '@/components/partials/Header.vue'
 import Footer from '@/components/partials/Footer.vue'
import { ref } from 'vue'
 const open = ref(false)
  const openMenu = () => {
    open.value = !open.value
  }
</script>