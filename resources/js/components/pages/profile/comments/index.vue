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
                       <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="ml-1">{{$t('pending_comments')}}</span>
                    </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a @click="setActive(1)" class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-primary duration-200" :class="{'bg-white':step == 1}"
                    data-tab-target="" role="tab" aria-selected="false">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>

                    <span class="ml-1">{{$t('approved')}}</span>
                    </a>
                </li>
               
                </ul>
            </div>
        </div> 
       </div>


       <div class=" w-full pb-4 space-y-10">
          <div class=" w-full flex flex-col items-start space-y-8">

            <div class="flex w-full items-start gap-2.5" v-for="(item,index,key) in comments" :key="key">
             <img class="w-8 h-8 rounded-full" :src="'https://api.dicebear.com/6.x/initials/svg?seed=' + item.first_name + ' ' + item.last_name" alt="Jese image">
            <div class="flex flex-col gap-1 w-full max-w-[320px]">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900 ">{{item.first_name + ' '+ item.last_name}}</span>
                    <span class="text-sm font-normal text-gray-500 ">{{formatDate(item.created_at)}}</span>
                </div>
                <div class="flex flex-col leading-1.5 p-4 max-w-[16rem] sm:max-w-full border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl ">
                    <p class="text-sm font-normal text-gray-900 break-words ">{{item.comment}} </p>
                </div>
               
            </div>
           <div class=" flex flex-col items-center space-y-2">
             <button v-if="step == 0" @click="ApproveComment(item.id)" id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 hover:scale-110 duration-200  rounded-lg bg-gray-100 focus:ring-4 focus:outline-none  focus:ring-gray-50  " type="button">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>
            <button @click="DeleteComment(item.id)" id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 hover:scale-110 duration-200  rounded-lg bg-gray-100 focus:ring-4 focus:outline-none  focus:ring-gray-50  " type="button">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </button>
           </div>

            </div>

            <div class=" w-full h-20 flex" v-if="comments.length == 0">
                <div class=" m-auto">
                    <h1>{{$t('no')}} {{ step == 0 ? $t('pending') : $t('approved')}} {{$t('comments')}}</h1>
                </div>
            </div>

          </div>
      
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
import { useRoute, useRouter } from "vue-router";
const route = useRoute()
const router = useRouter()
import axios from "axios";
const store = useStore()
const step = ref(0)

const comments = ref([])

const setActive = (index) => {
    step.value = index
    getComments(index)
}

 const formatDate = (inputDateString) => {
  const date = new Date(inputDateString);
 
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based
  const day = String(date.getDate()).padStart(2, '0');

  // Create the formatted date string
  const formattedDate = `${year}-${month}-${day}`;

  return formattedDate;
}

const getComments = (status) => {
    axios.get('/api/profile/'+ route.params.id +'/comments/' + status).then((res) => {
        comments.value = res.data
    }).catch((err) => {
        console.log(err)
    })
}

const ApproveComment = (id) => {
     axios.post('/api/profile/'+ route.params.id +'/comments/approve',
     {comment_id:id}
     ).then((res) => {
       getComments(step.value)
    }).catch((err) => {
        console.log(err)
    })
}

const DeleteComment = (id) => {
    if(!confirm('are you sure you want to delete this comment?')) return;
     axios.post('/api/profile/'+ route.params.id +'/comments/delete',
     {comment_id:id}
     ).then((res) => {
        
        getComments(step.value)
    }).catch((err) => {
        console.log(err)
    })
}

onMounted(() => {
    getComments(step.value)
})

</script> 