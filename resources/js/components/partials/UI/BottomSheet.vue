<template>
    <div class=" w-full z-10 rounded-t-2xl  border-t border-white  absolute bottom-0 duration-300 transition-all backdrop-blur-xl ease-in-out" :class="{'h-3/4':open,' h-[6rem] ':!open}">
        <div class=" w-full  relative p-4">
            <button @click="openSheet" class=" w-full absolute -top-1 left-0 flex cursor-pointer">
                <div class=" m-auto h-2 w-20 rounded-full bg-white"></div>
            </button>
            <div @click="openSheet" class=" w-full flex space-x-2 items-center cursor-pointer">
                <div class=" w-14 h-14 rounded-full border  overflow-hidden">
                    <img  :src="profile.image" class=" w-full h-full object-cover" alt="">
                </div>
                <div class=" flex flex-col items-start -space-y-1">
                    <span class=" text-white uppercase font-Altivo text-xl font-medium">{{profile.fullname}}</span>
                    <span class=" text-white font-Inter text-base">☨ {{profile.birthday}} - {{profile.death}}</span>
                </div>
            </div>

            <div class=" absolute bottom-4 right-4 z-20 space-x-2">
                <button v-if="!open" @click="open = true; openType = 'comments'">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-white">
                        <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                        <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                    </svg>
                </button>
                <button v-if="openType === 'comments' && open" @click="openType = 'addcomment'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white hover:text-opacity-75 duration-200">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-white" :class="{'w-14 h-14':open}">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                    </svg>
                </button>
            </div>
        </div>

     <div class=" w-full h-full px-4" v-if="open">
       <div class=" w-full h-[70%] md:h-[80%] overflow-y-auto ">
         <div class=" w-full p-4 space-y-4" v-if="openType === 'details'">
            <p class=" text-white text-lg font-Altivo font-normal">
                {{profile.description}}
            </p>
             <p class=" text-white text-lg font-Altivo font-normal">
                {{profile.miscellaneous}}
            </p>
            
        </div>
        <div class=" w-full flex flex-col items-start space-y-4" v-else-if="openType === 'comments'">
            
                <div v-for="(item,index,key) in comments" :key="key" class="flex items-start gap-2.5">
                 <img class="w-8 h-8 rounded-full" :src="'https://api.dicebear.com/6.x/initials/svg?seed=' + item.first_name + ' ' + item.last_name" alt="Jese image">
                <div class=" w-full max-w-[320px] flex items-start space-y-2 flex-col">
                    <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-[#565352] bg-opacity-30  rounded-e-xl rounded-es-xl ">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <span class="text-sm  text-white font-Altivo ">{{item.first_name + ' ' + item.last_name}}</span>
                        <span class="text-sm font-normal text-gray-300 ">{{formatDate(item.created_at)}}</span>
                    </div>
                    <p class="text-sm font-normal py-2.5 text-white ">{{item.comment}}</p>
                
                </div>
                    <!-- <div class=" w-full flex items-center space-x-2">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                        <span class=" text-white text-sm font-Altivo">1</span>
                    </div> -->
                </div>
                
                </div>
                

        </div>
        <div class=" w-full" v-else>
            <div class=" w-full" v-if="success">
                     <div
                        class="relative block w-full p-4 mb-4 text-base leading-5 text-white bg-green-500 rounded-lg opacity-100 font-regular">
                        Comment successfully created. It will be displayed once approved by the profile owner.
                    </div>
            </div>
            <div class=" w-full">
                  <div class=" w-full pt-10 space-y-7">
                       <div class=" w-full flex items-end  gap-4">
                            <div class=" flex flex-col w-full items-start">
                                    <span class=" text-red-500 font-Altivo text-base" v-if="errors.first_name">{{errors.first_name[0]}}</span>
                                    <div class="relative w-full">
                                        <input
                                        :class="{'border-2 border-red-500':errors.first_name}"
                                        v-model="form.first_name"
                                        type="text" 
                                        class="peer outline-none w-full h-11 bg-transparent text-white font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                        placeholder="" id="fullname" name="fullname" /><label for="fullname"
                                        class="flex w-full text-gray-950 h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                            First name*
                                        </label>
                                    </div>
                            </div>
                             <div class=" flex flex-col w-full items-start">
                                    <span class=" text-red-500 font-Altivo text-base" v-if="errors.last_name">{{errors.last_name[0]}}</span>
                                    <div class="relative w-full">
                                        <input
                                        :class="{'border-2 border-red-500':errors.last_name}"
                                        v-model="form.last_name"
                                        type="text" 
                                        class="peer outline-none w-full h-11 bg-transparent text-white font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                                        placeholder="" id="lastname" name="lastname" /><label for="lastname"
                                        class="flex w-full text-gray-950 h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                                            Last name*
                                        </label>
                                    </div>
                            </div>
                       </div>
                        <div class=" w-full flex flex-col items-start">
                            <span class=" text-red-500 font-Altivo text-base" v-if="errors.comment">{{errors.comment[0]}}</span>
                           <div class="relative w-full min-w-[200px]">
                             <textarea
                            :class="{'border-2 border-red-500':errors.comment}"
                            v-model="form.comment"
                            class="peer h-full text-white text-lg min-h-[100px] w-full resize-none rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 font-sans  font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" "></textarea>
                            <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                             Comment
                            </label>
                           </div>
                        </div>
                   </div>
                    <div class=" w-full py-4 px-4">
                 
                      <button :disabled='loading' @click="CreateComment" class=" uppercase text-white bg-primary rounded-md hover:scale-y-110 duration-200 w-full py-2 font-Altivo text-lg">
                            <div role="status" v-if="loading">
                                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            {{loading ?  '' :'Create Comment'}}    
                     </button>
                </div>
            </div>
        </div>
       </div>

       <div class=" w-full  flex">
        <div class=" flex items-center pt-3 sm:pt-5 space-x-4 m-auto">
            <button @click="openType = 'details'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10  duration-200" :class="{' text-[#5C5A5A]':openType != 'details','text-white':openType == 'details'}">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
            </button>
             <button @click="openType = 'comments'">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10  duration-200" :class="{' text-[#5C5A5A]':openType != 'comments','text-white':openType == 'comments'}">
                        <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                        <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                    </svg>
                </button>
        </div>
       </div>
     </div>
    </div>
</template>


<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "@/stores/states.js"

 const store = useStore()
 const props = defineProps(['profile'])
 const openType = ref('details')
 const errors = ref([])
 const open = ref(false)
 const loading = ref(false)
 const success = ref(false)
 const comments = ref([])
 const route = useRoute()
 const form = ref({
    first_name:'',
    last_name:'',
    comment:''
 })

 const CreateComment = () => {
    if(!loading) return;
    loading.value = true
    success.value = false
    axios.post('/api/profile/comment/'+ props.profile.id+'/create',form.value).then((res) => {
         success.value = true
         form.value.comment = ''
         errors.value = []
    }).catch((error) => {
         success.value = false
          if (error.response && error.response.status === 422) {
            // 422 Unprocessable Entity error
            errors.value = error.response.data.errors;
           } 
           else {
                // Handle other types of errors here
                console.log('Other error:', error.message);
            }
    }).finally(() => {
        loading.value = false
    })
 }

 const loadComments = () => {
    axios.get('/api/profile/'+ route.params.id +'/comments').then((res) => {
        comments.value = res.data
    }).catch((err) => {
        console.log(err)
    })
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


onMounted( () => {
    loadComments()
    if(store.user){
        form.value.first_name = store.user.first_name;
        form.value.last_name = store.user.last_name
    }
})

 const openSheet = () => {
    open.value = !open.value
 }
</script>


<style scoped>
::-webkit-scrollbar {
  width: 5px; /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
  background-color: #a7a7a758; /* Color of the track */
}

::-webkit-scrollbar-thumb {
  background-color: white; /* Color of the thumb */
  border-radius: 6px; /* Rounded corners of the thumb */
}

::-webkit-scrollbar-thumb:hover {
  background-color: #555; /* Color of the thumb on hover */
}
</style>