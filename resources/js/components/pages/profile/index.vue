<template>
  <MainLayouts>
    <div class=" w-full h-full flex flex-col items-start space-y-8 py-8 px-4 overflow-hidden">
        <div class=" flex items-center space-x-4">
            <div class=" w-24 h-24 rounded-full bg-[#F4EFEF] p-2 shadow">
                <div class=" w-full h-full rounded-full bg-white overflow-hidden flex">
                    <!-- <span class=" text-primary text-4xl font-Altivo font-medium m-auto">AC</span> -->
                    <img :src="'https://api.dicebear.com/6.x/initials/svg?seed=' + store.user.first_name + ' ' + store.user.last_name" class=" w-full h-full" alt="">
                </div>
            </div>
            <div class=" flex flex-col items-start">
                <span class=" text-primary text-xl font-medium font-Inter">{{store.user.email}}</span>
                <span class=" text-primary font-Altivo text-lg font-normal">{{profiles.length}} SEELENSTEINE</span>
            </div>
        </div>


        <div class=" w-full" v-if="profiles.length == 0">
              <div role="alert"
                    class="relative flex w-full px-4 py-4 text-base text-gray-900 border border-gray-900 rounded-lg font-regular"
                    style="opacity: 1;">
                    <div class="shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6">
                        <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                        clip-rule="evenodd"></path>
                    </svg></div>
                    <div class="ml-3 mr-12">
                    <p class="block font-sans text-base antialiased font-medium leading-relaxed text-inherit">You currently do not have any profile</p>
                    <ul class="mt-2 ml-2 list-disc list-inside">
                        <li>Buy profile from here <a href="" target="_blank" class=" text-green-500 hover:underline text-lg font-Altivo">buy now</a></li>
                    </ul>
                    </div>
                </div>
        </div>
       

        <div class=" w-full flex flex-col items-start space-y-4">
            <div v-for="(profile,index,key) in profiles" :key="key" :class="{'ring':!profile.step_one_completed || !profile.step_two_completed}" class=" w-full  ring-red-400 bg-[#F2F2F1] rounded-md flex items-center justify-between px-5 shadow py-7">
                <div class=" flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-primary">
                      <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                    <span class=" text-primary  text-xl font-normal" :class="{'font-Altivo':profile.fullname == ''}">{{profile.fullname ? profile.fullname : "-"}}</span>

                </div>
                 <div class=" flex items-center space-x-2">
                    <button class=" group relative" v-if="!profile.step_one_completed || !profile.step_two_completed">
                          <div 
                            class="absolute  ransition-all scale-0 group-hover:scale-100 duration-200 -left-16 -top-10 z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                             <span class=" whitespace-nowrap text-lg font-Altivo">Incomplete Profile.</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-orange-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>

                    </button>
                    <router-link :to="'/profile/' + profile.id + '/edit'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-primary hover:text-opacity-65 duration-200">
                          <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                    </router-link>
                    <router-link to="/profile/1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-primary hover:text-opacity-65 duration-200">
                          <path fill-rule="evenodd" d="M15.75 2.25H21a.75.75 0 0 1 .75.75v5.25a.75.75 0 0 1-1.5 0V4.81L8.03 17.03a.75.75 0 0 1-1.06-1.06L19.19 3.75h-3.44a.75.75 0 0 1 0-1.5Zm-10.5 4.5a1.5 1.5 0 0 0-1.5 1.5v10.5a1.5 1.5 0 0 0 1.5 1.5h10.5a1.5 1.5 0 0 0 1.5-1.5V10.5a.75.75 0 0 1 1.5 0v8.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V8.25a3 3 0 0 1 3-3h8.25a.75.75 0 0 1 0 1.5H5.25Z" clip-rule="evenodd" />
                        </svg>

                    </router-link>
                </div>
            </div>
            
        </div>
    </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import { onMounted, ref } from "vue";
import { useStore } from "@/stores/states.js"
const store = useStore()

import axios from "axios";

const profiles = ref([]);

const getProfile = () => {
    axios.get('/api/get-profiles').then((res) => {
        console.log(res)
        profiles.value = res.data
    }).catch((error) => [
        console.log(error)
    ])
}

onMounted(() => {
    getProfile()
})

</script>