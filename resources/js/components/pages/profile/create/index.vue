<template>
  <MainLayouts>
    <div class=" w-full h-full flex flex-col items-start space-y-8 py-8 px-4">
       <div class=" w-full">
        <div class=" w-full">
            <div class="relative right-0">
                <ul class="relative flex flex-wrap p-1 list-none rounded-xl bg-gray-100" data-tabs="tabs" role="list">
                <li class="z-30 flex-auto text-center">
                    <a @click="setActive(0)" class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-primary duration-200" :class="{'bg-white':step == 0}"
                    data-tab-target="" active role="tab" aria-selected="true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                    <span class="ml-1">{{$t('details')}}</span>
                    </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a @click="setActive(1)" class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-primary duration-200" :class="{'bg-white':step == 1}"
                    data-tab-target="" role="tab" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="ml-1">{{$t('media')}}</span>
                    </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a @click="setActive(2)" class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-primary duration-200 " :class="{'bg-white':step == 2}"
                    data-tab-target="" role="tab" aria-selected="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <span class="ml-1">{{$t('accesses')}}</span>
                    </a>
                </li>
                </ul>
            </div>
        </div> 
       </div>


       <div class=" w-full pb-4">
          <Details v-if=" step == 0" @next='setActive(1)' />
          <Media v-else-if="step == 1" @next='setActive(2)'/>
          <Accesses v-else-if="step == 2" />
          <div class=" w-full py-2">
             <router-link to="/profile" class=" w-full">
                   <button class=" uppercase bg-white border-2 border-primary text-primary rounded-md hover:scale-y-110 duration-200 w-full py-2 font-Altivo text-lg">{{$t('back')}}</button>
               </router-link>
          </div>
       </div>

       
    </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import Details from '@/components/pages/profile/create/tabs/Details.vue'
import Media from '@/components/pages/profile/create/tabs/Media.vue'
import Accesses from '@/components/pages/profile/create/tabs/Accesses.vue'
import { onMounted, ref } from "vue";
import { useStore } from "@/stores/states.js"
const store = useStore()
const step = ref(0)



const setActive = (index) => {
    step.value = index
}


</script>