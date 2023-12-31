<template>
    <div class=" w-full space-y-8">
      <div class=" w-full">

        <label class="block mb-2 text-sm font-medium text-primary  " for="file_input">Upload files</label>
        <input @change="getImages" multiple  accept="image/*,video/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none " aria-describedby="file_input_help" id="file_input" type="file">
        <p class="mt-1 text-sm text-gray-500 " id="file_input_help">PNG, JPG or GIF, video. (multiple)</p>

      </div>


      <div class=" w-full grid grid-cols-4 gap-4">
        <div class=" w-full relative" v-for="(item,index,key) in store.profile.step2.images" :key="key" >
         <div class=" w-full h-24 bg-gray-300 rounded-lg overflow-hidden">
            <img :src="item.src" v-if="item.type != 'video/mp4' && item.type != 'video/webm' && item.type != 'video/ogg'" class=" w-full h-full object-cover" alt="">
           <video :src="item.src" :type="item.type" v-else class="w-full h-full object-cover"  muted autoplay>
              Your browser does not support the video tag.
          </video>

        </div>
        <button class=" absolute -top-2 -right-2" @click="RemoveFile(index)">
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
import { useStore } from "@/stores/states.js"

const store = useStore();

const getImages = (e) => {
  const fileInput = e.target;

  // Check if files are selected
  if (fileInput.files.length > 0) {
    const selectedFiles = fileInput.files;

    // Validate file types
    const allowedTypes = ['image/png', 'image/jpeg', 'image/gif', 'video/*'];

    for (const file of selectedFiles) {
      if (!allowedTypes.some(type => file.type.startsWith(type.split('/')[0]))) {
        // Invalid file type
        alert('Invalid file type. Please select only images (png, jpg, gif) or videos.');
        // Reset the file input to clear the selection
        fileInput.value = '';
        return;
      }
    }

    // Read each selected file as base64
    for (const file of selectedFiles) {
      const reader = new FileReader();

      reader.onload = (event) => {
        const base64String = event.target.result;
        const fileType = file.type;
        // Now you can use the base64String as needed for each file
        store.profile.step2.images.push({src:base64String,type:fileType})
      };

      reader.readAsDataURL(file);
    }
  }
};


const RemoveFile = (index) => {
  store.profile.step2.images.splice(index,1)
}




</script>