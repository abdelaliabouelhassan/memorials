<template>
  <MainLayouts>
    <div class=" w-full h-full flex py-4 px-4">
        <div class=" m-auto space-y-4">
           <div >
             <h1 class=" text-2xl font-Altivo text-primary font-medium">UNVERGESSLICHE MOMENTE,</h1>
            <span  class=" text-xl font-Altivo text-primary font-normal">EWIGE ERINNERUNGEN</span>
           </div>

            <p class=" text-sm font-Altivo font-normal text-black max-w-xs">
              LOG IN TO MANAGE YOUR SOULSTONES
              OR BUY A SOUL MIRROR TO PRESERVE THE
              MEMORIES OF YOUR LOVED ONES.
            </p>

            <div class=" w-full flex flex-col items-start space-y-2 pt-10">
              <button class=" uppercase text-white bg-primary rounded-md hover:scale-x-110 duration-200 w-full py-2 font-Altivo text-lg">go to shop</button>
               <router-link to="/login" class=" w-full">
                   <button class=" uppercase bg-white border-2 border-primary text-primary rounded-md hover:scale-x-110 duration-200 w-full py-2 font-Altivo text-lg">log in</button>
               </router-link>
              
            </div>
        </div>
    </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import { onMounted } from "vue";

</script>