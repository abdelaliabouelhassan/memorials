<template>
  <MainLayouts>
    <div class=" w-full h-full flex py-4 px-4">
        <div class=" m-auto space-y-4">
           <div >
             <h1 class=" text-2xl font-Altivo text-primary font-medium uppercase">{{$t('unforgettable_moments')}},</h1>
            <span  class=" text-xl font-Altivo text-primary font-normal uppercase">{{$t('eternal_memories')}}</span>
           </div>

            <p class=" text-sm uppercase font-Altivo font-normal text-black max-w-xs">
              {{$t('login_to_manage_text')}}
            </p>

            <div class=" w-full flex flex-col items-start space-y-2 pt-10">
              <a href="https://seelenstein.de/products/der-seelenstein" target="_blank" class=" w-full">
                <button class=" uppercase text-white bg-primary rounded-md hover:scale-x-110 duration-200 w-full py-2 font-Altivo text-lg">{{$t('go_to_shop')}}</button>
              </a>
              <router-link to="/login" class=" w-full">
                 <button class=" uppercase bg-white border-2 border-primary text-primary rounded-md hover:scale-x-110 duration-200 w-full py-2 font-Altivo text-lg">{{store.user.email ? $t('my_profiles') : $t('login')}}</button>
              </router-link>
              
            </div>
        </div>
    </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import { onMounted } from "vue";
import { useStore } from "@/stores/states.js"
const store = useStore()
</script>