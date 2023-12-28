<template>
  <div class=" w-full h-screen overflow-hidden  relative ">
   <div class=" w-full max-w-lg border-2 h-full max-h-full mx-auto space-y-4 relative">
     <Header /> 
     <div class=" w-full h-full pt-16 pb-20">
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
</script>