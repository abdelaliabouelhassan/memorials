<template>
  <MainLayouts>
    <div class=" w-full h-full flex py-4 px-4">
        <div class=" m-auto space-y-4 w-full max-w-sm">
            <div class=" flex flex-col items-start space-y-2">
                <h1 class=" text-[#524C57] text-2xl font-Altivo font-normal">{{$t('forgot_password')}}</h1>
                <span class=" text-[#87848B] text-lg font-Inter font-normal">{{$t("please_email")}}</span>
            </div>
                <div
                v-if="success"
                class="relative block w-full p-4 mb-4 text-base leading-5 text-white bg-green-500 rounded-lg opacity-100 font-regular">
                {{$t('reset_password_sent')}}
            </div>
         

            <div class=" w-full space-y-4 pt-14 ">
               
               <div class=" flex flex-col items-start">
                  <span class=" text-red-500 font-Altivo text-base" v-if="errors.email">{{errors.email[0]}}</span>
                <div class="relative w-full">
                    <input
                    type="email"
                     :class="{'border-2 border-red-500':errors.email}"
                     v-model="form.email"
                    class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                    placeholder="" id="email" name="password" /><label for="email"
                    class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                        {{$t('email')}}
                    </label>
                </div>  
               </div>

                

           

            

                <div class=" w-full py-4">

                     <button :disabled='loading' @click="sendLink" class=" uppercase text-white bg-primary rounded-md hover:scale-x-110 duration-200 w-full py-2 font-Altivo text-lg">
                          <div role="status" v-if="loading">
                                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">{{$t('loading')}}...</span>
                            </div>
                            {{loading ?  '' : $t('submit')}}
                        
                        </button>
                </div>

         
                

                 
            </div>

        </div>
    </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import { onMounted,ref } from "vue";
import { useRouter } from 'vue-router';
import axios from 'axios'

const router = useRouter();
const form = ref({
    email:'',
})
const success = ref(false)
const errors = ref([])
const loading = ref(false)

const sendLink = () => {
    if(!loading) return;
    errors.value = []
    success.value = false
    loading.value = true
    axios.post('/password/email',form.value).then((res) => { 
        success.value = true
    }).catch((error) => {
        console.log(error)
        success.value = false
         if (error.response && error.response.status === 422) {
            // 422 Unprocessable Entity error
            errors.value = error.response.data.errors;
            // console.log('Validation errors:', errors.value);
        
           } 
           else {
                // Handle other types of errors here
                console.log('Other error:', error);
            }
    }).finally(() => {
        loading.value = false
    })
}

</script>