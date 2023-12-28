<template>
  <div class=" w-full h-screen overflow-hidden relative px-4">
   <div class=" w-full max-w-lg border-2 h-full max-h-full mx-auto space-y-4 relative">
     <Header /> 
      <div class=" w-full max-h-full h-full pb-[4.7rem] pt-[3.4rem] overflow-y-auto">
         <slot />
      </div>
     <Footer />
   </div>
  </div>
</template>

<script setup>
 import Header from '@/components/partials/Header.vue'
  import Footer from '@/components/partials/Footer.vue'
</script>