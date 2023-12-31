<template>
    <div class=" w-full space-y-8">
      <div class=" w-full">

        <label class="block mb-2 text-sm font-medium text-primary  " for="file_input">Upload files</label>
        <input multiple  accept="image/*,video/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none " aria-describedby="file_input_help" id="file_input" type="file">
        <p class="mt-1 text-sm text-gray-500 " id="file_input_help">PNG, JPG or GIF, video.</p>

      </div>


      <div class=" w-full grid grid-cols-4 gap-4">
        <div class=" w-full relative" >
         <div class=" w-full h-24 bg-gray-300">

        </div>
        <button class=" absolute -top-2 -right-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 hover:text-opacity-75 duration-200">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
           </svg>
        </button>
        </div>
      </div>
        <button class=" uppercase text-white bg-primary rounded-md hover:scale-y-110 duration-200 w-full py-2 font-Altivo text-lg">Next</button>

      
    </div>
</template>


<script setup>
import { onMounted } from "vue";
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
</script>