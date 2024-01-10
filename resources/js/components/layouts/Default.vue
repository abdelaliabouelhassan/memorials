<template>
  <div  class=" w-full h-screen max-h-full overflow-y-hidden fixed  overflow-hidden   ">
   <div class=" w-full max-w-lg md:max-w-full sm:border-2 h-full max-h-full mx-auto relative">
     <Header @openMenu='openMenu' :theme='theme' /> 
     <div class=" w-full max-w-lg mx-auto h-full pt-[3.2rem] md:border  relative" :class="{'pb-20':theme != 'dark'}">
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

          <div class=" w-full p-4 absolute bottom-14">
            <button @click="logOut" v-if="store.user.email" class=" w-full bg-primary rounded-full h-12 flex hover:scale-y-110 duration-200">
            <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 m-auto text-white h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
           </svg>
          </button>
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
 import axios from 'axios'
 import { onMounted, ref } from 'vue'
 import { useRouter } from 'vue-router';
 import { useStore } from "@/stores/states.js"
 
 const safari = ref(null)
 const   getBrowserName = () => {
   
     const userAgent = navigator.userAgent;

      if (userAgent.indexOf('Chrome') !== -1) {
       safari.value = false
       return 'Chrome';
      } else if (userAgent.indexOf('Safari') !== -1) {
       safari.value = true
       return 'Safari';
      } else if (userAgent.indexOf('Firefox') !== -1) {
       safari.value = false
       return 'Firefox';
      } else if (userAgent.indexOf('Edge') !== -1) {
       safari.value = false
       return 'Edge';
      } else if (userAgent.indexOf('MSIE') !== -1 || userAgent.indexOf('Trident/') !== -1) {
        safari.value = false
        return 'MSIE';
      } else {
       safari.value = false
       return 'none';
      }
      
}

 const store = useStore()
 const router = useRouter();
 
 const props = defineProps(['theme'])

  const open = ref(false)
  const openMenu = () => {
    open.value = !open.value
  }

  const logOut = () => {
    axios.post('/api/logout').then((res) => {
        localStorage.removeItem('token');
        // Reset the axios Authorization header:
        axios.defaults.headers.common['Authorization'] = 'Bearer';
        store.user = [];
        // Redirect the user to the login page:
        window.location.href = '/'
    })
  }

  onMounted(() => {
    console.log(getBrowserName())
  })
</script>