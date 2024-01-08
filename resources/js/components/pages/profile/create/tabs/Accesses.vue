<template>
    <div class=" w-full space-y-8">
        <div class=" w-full">
            <div class=" w-full flex items-center space-x-4 -space-y-1">
            <label class="block mb-2 text-base font-medium text-primary " for="file_input">{{$t('make_it_private')}}</label>
            <div class="inline-flex items-center">
                <div class="relative inline-block w-8 h-4 rounded-full cursor-pointer">
                <input v-model="store.profile.step3.private" id="switch-6" type="checkbox"
                    class="absolute w-8 h-4 transition-colors duration-300 rounded-full appearance-none cursor-pointer peer bg-gray-300 checked:bg-primary peer-checked:border-primary peer-checked:before:bg-primary" />
                <label htmlFor="switch-6"
                    class="before:content[''] absolute top-2/4 -left-1 h-5 w-5 -translate-y-2/4 cursor-pointer rounded-full border border-blue-gray-100 bg-white shadow-md transition-all duration-300 before:absolute before:top-2/4 before:left-2/4 before:block before:h-10 before:w-10 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10 peer-checked:translate-x-full peer-checked:border-indigo-500 peer-checked:before:bg-indigo-500">
                    <div class="inline-block p-5 rounded-full top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4"
                    data-ripple-dark="true"></div>
                </label>
                </div>
            </div>
        </div>
        <p class="mt-1 text-sm text-gray-500 " id="file_input_help">{{$t('making_it_private_only')}}</p>
        </div>
        <div class=" flex flex-col items-start">
                  <!-- <span class=" text-red-500 font-Altivo text-base" v-if="errors.password">{{errors.password[0]}}</span> -->
                  <div class="relative w-full">
                    <input
                    v-model="store.profile.step3.password"
                    type="text" 
                    class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                    placeholder="" id="fullname" name="fullname" /><label for="fullname"
                    class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                        {{$t('add_password')}}
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-500 " id="file_input_help">{{$t('bg_adding_password')}}</p>
        </div>
        <button :disabled='loading' @click="Save" class=" uppercase text-white bg-primary rounded-md hover:scale-y-110 duration-200 w-full py-2 font-Altivo text-lg">
                <div role="status" v-if="loading">
                    <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                {{loading ?  '' : $t('save')}}
            
        </button>
        
    </div>
</template>


<script setup>
import { onMounted, ref } from "vue";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

import { useStore } from "@/stores/states.js"
import { useRoute, useRouter } from "vue-router";
const store = useStore();

const route = useRoute()
const router = useRouter()
const emit = defineEmits('next')
const errors = ref([])
const loading = ref(false)

const getStep3 = () => {
    axios.get('/api/profile/'+ route.params.id +'/details').then((res) => {
        console.log(res)
        store.profile.step3.private = res.data.private ? true : false;
        store.profile.step3.password = res.data.password;

    }).catch((err) => {
        console.log(err)
        router.push('/profile')
    })
}


const Save = () => {
    if(!loading) return;
    loading.value = true
    errors.value = []
    axios.post('/api/profile/'+ route.params.id +'/access/store',store.profile.step3).then((res) => {
        console.log(res)
        router.push('/profile')
    }).catch((error) => {
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

onMounted(() => {
    getStep3()
})

</script>