<template>
    <div class=" w-full space-y-8">
        <div class=" w-full">
            <div class=" w-full flex items-center space-x-4 -space-y-1">
            <label class="block mb-2 text-base font-medium text-primary " for="file_input">Make it Private</label>
            <div class="inline-flex items-center">
                <div class="relative inline-block w-8 h-4 rounded-full cursor-pointer">
                <input  id="switch-6" type="checkbox"
                    class="absolute w-8 h-4 transition-colors duration-300 rounded-full appearance-none cursor-pointer peer bg-gray-300 checked:bg-primary peer-checked:border-primary peer-checked:before:bg-primary" />
                <label htmlFor="switch-6"
                    class="before:content[''] absolute top-2/4 -left-1 h-5 w-5 -translate-y-2/4 cursor-pointer rounded-full border border-blue-gray-100 bg-white shadow-md transition-all duration-300 before:absolute before:top-2/4 before:left-2/4 before:block before:h-10 before:w-10 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity hover:before:opacity-10 peer-checked:translate-x-full peer-checked:border-indigo-500 peer-checked:before:bg-indigo-500">
                    <div class="inline-block p-5 rounded-full top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4"
                    data-ripple-dark="true"></div>
                </label>
                </div>
            </div>
        </div>
        <p class="mt-1 text-sm text-gray-500 " id="file_input_help">By making it private, only you will have access.</p>
        </div>
        <div class=" flex flex-col items-start">
                  <!-- <span class=" text-red-500 font-Altivo text-base" v-if="errors.password">{{errors.password[0]}}</span> -->
                  <div class="relative w-full">
                    <input
                    type="password" 
                    class="peer outline-none w-full h-11 bg-transparent text-blue-gray-700 font-sans font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border focus:border-2 focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] border-blue-gray-200 focus:border-gray-900"
                    placeholder="" id="fullname" name="fullname" /><label for="fullname"
                    class="flex w-full h-full select-none pointer-events-none absolute left-0 font-normal !overflow-visible truncate peer-placeholder-shown:text-blue-gray-500 leading-tight peer-focus:leading-tight peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500 transition-all -top-1.5 peer-placeholder-shown:text-sm text-[11px] peer-focus:text-[11px] before:content[' '] before:block before:box-border before:w-2.5 before:h-1.5 before:mt-[6.5px] before:mr-1 peer-placeholder-shown:before:border-transparent before:rounded-tl-md before:border-t peer-focus:before:border-t-2 before:border-l peer-focus:before:border-l-2 before:pointer-events-none before:transition-all peer-disabled:before:border-transparent after:content[' '] after:block after:flex-grow after:box-border after:w-2.5 after:h-1.5 after:mt-[6.5px] after:ml-1 peer-placeholder-shown:after:border-transparent after:rounded-tr-md after:border-t peer-focus:after:border-t-2 after:border-r peer-focus:after:border-r-2 after:pointer-events-none after:transition-all peer-disabled:after:border-transparent peer-placeholder-shown:leading-[3.75] text-gray-500 peer-focus:text-gray-900 before:border-blue-gray-200 peer-focus:before:!border-gray-900 after:border-blue-gray-200 peer-focus:after:!border-gray-900">
                        Add Password
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-500 " id="file_input_help">By adding a password, you will be prompted for it to access your profile.</p>
        </div>
          <button class=" uppercase text-white bg-primary rounded-md hover:scale-y-110 duration-200 w-full py-2 font-Altivo text-lg">Create</button>
        
    </div>
</template>


<script setup>
import { onMounted } from "vue";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
</script>