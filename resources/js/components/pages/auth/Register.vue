<template>
  <MainLayouts>
    <div class=" w-full h-full flex py-4 px-4">
        <div class=" m-auto space-y-4 w-full max-w-sm">
            <div class=" flex flex-col items-start space-y-2">
                <h1 class=" text-[#524C57] text-2xl font-Altivo font-normal">Welcome  👋🏻</h1>
                <span class=" text-[#87848B] text-lg font-Inter font-normal">Please Sign-up below</span>
            </div>

             <div
                v-if="success"
                class="relative block w-full p-4 mb-4 text-base leading-5 text-white bg-green-500 rounded-lg opacity-100 font-regular">
                Your Account successfully created!
            </div>


            <div>

            </div>

            <div class=" w-full space-y-4 pt-14 ">
                <div class=" flex flex-col items-start">
                    <span class=" text-red-500 font-Altivo text-base" v-if="errors.first_name">{{errors.first_name[0]}}</span>
                    <div class="relative w-full">
                        <input
                        v-model="form.first_name"
                            type="text"
                            :class="{'border-2 border-red-500':errors.first_name}"
                            class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                            placeholder="" id="firstname" name="firstname" />
                            <label for="firstname"
                        
                            class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                            First Name
                        </label>
            
                    </div> 
                </div>

                 <div class=" flex flex-col items-start">
                     <span class=" text-red-500 font-Altivo text-base" v-if="errors.last_name">{{errors.last_name[0]}}</span>
                    <div class="relative w-full">
                        <input
                            v-model="form.last_name"
                            type="text"
                            :class="{'border-2 border-red-500':errors.last_name}"
                            class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                            placeholder="" id="lastname" name="lastname" /><label for="lastname"
                            class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                            Last Name
                        </label>
            
                    </div>  
                 </div>
               
                <div class=" flex flex-col items-start">
                     <span class=" text-red-500 font-Altivo text-base" v-if="errors.email">{{errors.email[0]}}</span>
                    <div class="relative w-full">
                        <input
                        v-model="form.email"
                        type="email"
                        :class="{'border-2 border-red-500':errors.email}"
                        class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                        placeholder="" id="email" name="password" /><label for="email"
                        class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                            E-mail
                        </label>
            
                    </div>  
                </div>

               <div class=" flex flex-col items-start">
                 <span class=" text-red-500 font-Altivo text-base" v-if="errors.password">{{errors.password[0]}}</span>
                 <div class="relative w-full">
                    <input
                    v-model="form.password"
                    type="password"
                     :class="{'border-2 border-red-500':errors.password}"
                    class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                    placeholder="" id="password" name="password" /><label for="password"
                    class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                        Password
                    </label>

                  <div class=" absolute right-2 top-2.5">
                      <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                  </div>
                 </div>
               </div>

              

                <div class=" w-full py-4">
                      <button :disabled='loading' @click="register" class=" uppercase text-white bg-primary rounded-md hover:scale-x-110 duration-200 w-full py-2 font-Altivo text-lg">Register</button>
                </div>

                <div class="  w-full flex">
                    <p class=" m-auto text-[#87848B] text-lg font-Altivo font-normal">
                         already have an account?
                        <router-link to="/login" class=" text-primary p-2">Login</router-link>
                    </p>
                </div>
                

                 
            </div>

            <div class=" w-full flex flex-col items-center space-y-8 py-10">
                <div class=" w-full border relative ">
                    <div class=" absolute w-full -top-[1.3rem] left-0 flex ">
                        <div class=" bg-white p-2 text-lg text-gray-400 font-Altivo font-normal m-auto">
                            or
                        </div>
                    </div>
                </div>

                  <div class=" flex items-center space-x-4">
                    <a href="/api/facebook/auth">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" w-8 h-8 text-[#3B5EA1]" viewBox="0 0 16 16">
                           <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                        </svg>
                    </a>
                    <a href="/api/twitter/auth">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" w-8 h-8 text-[#1BA0F0]" viewBox="0 0 16 16">
                          <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15"/>
                        </svg>
                    </a>
                    <a href="/api/google/auth">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  class=" w-8 h-8 text-[#DA4337]"  viewBox="0 0 16 16">
                          <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import { onMounted, ref } from "vue";
import { useRouter } from 'vue-router';
import axios from 'axios'
const router = useRouter();
const form = ref({
    first_name:'',
    last_name:'',
    email:'',
    password:'',
})
const success = ref(false)
const errors = ref([])
const loading = ref(false)
const register = () => {
    if(!loading) return;
    errors.value = []
    success.value = false
    loading.value = true
    axios.post('/api/register',form.value).then((res) => {
        console.log(res)
        success.value = true
        setTimeout(() => {
            router.push('/login')
        },1000)
    }).catch((error) => {
        console.log(error)
        success.value = false
         if (error.response && error.response.status === 422) {
            // 422 Unprocessable Entity error
            errors.value = error.response.data.errors;
            console.log('Validation errors:', errors.value);
            } else {
                // Handle other types of errors here
                console.log('Other error:', error.message);
            }
    }).finally(() => {
        loading.value = false
    })
}

</script>