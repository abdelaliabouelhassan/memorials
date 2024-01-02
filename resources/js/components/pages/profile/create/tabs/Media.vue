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
        <button class=" absolute -top-2 -right-2" @click="RemoveFile(item,index)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 hover:text-opacity-75 duration-200">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
           </svg>
        </button>
        </div>
      </div>
        <button :disabled='loading' @click="Next" class=" uppercase text-white bg-primary rounded-md hover:scale-y-110 duration-200 w-full py-2 font-Altivo text-lg">
            <div role="status" v-if="loading">
                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            {{loading ?  '' :'Next'}}
            
        </button>

      
    </div>
</template>


<script setup>
import { onMounted, ref } from "vue";
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { useStore } from "@/stores/states.js"
import { useRoute, useRouter } from "vue-router";

const store = useStore();
const route = useRoute()
const router = useRouter()
const emit = defineEmits('next')
const errors = ref([])
const loading = ref(false)

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


const RemoveFile = (item,index) => {
  if(item.src.length > 50){
     store.profile.step2.images.splice(index,1);
     return;
  }else{
      if(!confirm('are you sure you want to delete?')) return;
      axios.post('/api/profile/'+ route.params.id +'/media/delete',{path:item.src}).then((res) => {
        console.log(res.data)
        store.profile.step2.images.splice(index,1)
    }).catch((err) => {
        console.log(err)
        router.push('/profile')
    })
  }
 
}


const Next = () => {
    if(!loading || store.profile.step2.images.length == 0) return;
    loading.value = true
    errors.value = []
    axios.post('/api/profile/details/'+ route.params.id +'/media',store.profile.step2).then((res) => {
        console.log(res)
        emit('next')
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

const getStep2 = () => {
   store.profile.step2.images = []
    axios.get('/api/profile/'+ route.params.id +'/media').then((res) => {
        console.log(res.data)
        res.data.forEach(element => {
          store.profile.step2.images.push({src:element.path,type:element.type})
        });

    }).catch((err) => {
        console.log(err)
        router.push('/profile')
    })
}

onMounted(() => {
  getStep2();
})



</script>