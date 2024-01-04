<template>
  <MainLayouts :theme="showPasseord ? 'password' :'dark'" class="">
   <div class=" w-full h-full" v-if="!showPasseord">
     <div v-if="mediaIndexMax > 0">
        <img v-if="getFileType(media[mediaIndex].type) == 'image'" :src="media[mediaIndex].path" class="  w-full h-full object-cover absolute top-0 left-0 " alt="">
        <video v-if="getFileType(media[mediaIndex].type) == 'video'" :src="media[mediaIndex].path" class=" w-full h-full absolute object-cover" muted autoplay></video>
    </div>
    <div class=" w-full h-full z-10 relative backdrop-blur-xl py-4 px-4 space-y-8 pt-10 ">
         <div class=" w-full max-w-sm mx-auto">
            <div class="w-full flex items-center space-x-4">
            <button @click="prev">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                 </svg>
            </button>
            <div class=" w-full h-2 border-white border max-w-[15rem] rounded-md overflow-hidden">
                <div class="h-full bg-white rounded-md" style="transition: width  ease-in-out;" :style="{ width: `${progress}%` }"></div>
            </div>
            <button @click="togglePause">
                <svg v-if='!paused' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                </svg>
            </button>
            <button @click="next">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
         </div>
         </div>

         <div v-if="mediaIndexMax > 0" class=" w-full rounded-md bg-gray-400 h-3/4 shadow-2xl overflow-hidden">
            <img v-if="getFileType(media[mediaIndex].type) == 'image'" :src="media[mediaIndex].path" class=" w-full h-full object-cover" alt="">
             <video v-if="getFileType(media[mediaIndex].type) == 'video'" :src="media[mediaIndex].path" class=" w-full h-full object-cover" muted autoplay controls></video>
         </div>
    </div>
    <BottomSheet :profile='profile' />
   </div>

   <div v-else class=" w-full h-full flex p-4">
    <div class="relative flex w-full m-auto max-w-[24rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
        <div
            class="relative grid px-4 py-8 m-0 overflow-hidden text-center text-white bg-primary place-items-center rounded-xl bg-clip-border shadow-gray-900/20">
            <div class="h-20 p-6 mb-4 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
            </div>
            <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-white">
             This profile is protected with a password.
            </h5>
        </div>
        <div class="p-6">
            <div class="block overflow-visible">
        
            <div class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                <div role="tabpanel"
                class="w-full p-0 font-sans text-base antialiased font-light leading-relaxed text-gray-700 h-max"
                data-value="card">
                <form class="flex flex-col gap-4 mt-12">
                    <div class="my-3">
                    <p class="block mb-2 font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                       Password
                    </p>
                    <div class="relative h-10 w-full min-w-[200px]">
                        <div
                        class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                        </svg>

                        </div>
                        <input placeholder="password"
                        v-model="password"
                        type="password"
                        :class="{'border-red-500':passwordError != ''}"
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200  !border-t-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:!border-t-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        value="" />
                        <label
                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all before:content-none after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all after:content-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"></label>
                    </div>
                
                    </div>
                    <button
                    @click="Unlock"
                    class="select-none rounded-lg bg-primary py-3.5 px-7 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                     Unlock
                    </button>
                    <p
                    class="flex items-baseline justify-center gap-2 mt-2 font-sans text-sm antialiased font-medium leading-normal text-gray-700 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        class="-mt-0.5 h-4 w-4">
                        <path fill-rule="evenodd"
                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                        clip-rule="evenodd"></path>
                    </svg>
                      Profiles are safeguarded with secure and encrypted access.
                    </p>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
   </div>
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import BottomSheet from '@/components/partials/UI/BottomSheet.vue'
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";


const duration = ref(5000); //5s
const progress = ref(0)
const animationId = ref(null)
const startTime = ref(null)
const paused = ref(false)
const router = useRouter();
const route = useRoute();
const showPasseord = ref(false)
const password  = ref('');
const passwordError = ref('')
const profile = ref([])
const media = ref([])
const mediaIndex = ref(0)
const mediaIndexMax = ref(0)


const Unlock = () => {
    passwordError.value = ''
    if(profile.value.password == password.value){
        showPasseord.value = false;
        startProgress()
    }else{
        passwordError.value = 'Invalid password.'
    }
}


const startProgress = () => {
    if (progress.value === 0 || progress.value === 100) {
        progress.value = 0; // Reset progress if starting a new progress
        paused.value = false
        animateProgress();
      }
}

const togglePause = () => {
    if(paused.value){
        resumeProgress()
    }else{
        pauseProgress()
    }
}

const pauseProgress = () => {
    cancelAnimationFrame(animationId.value);
    paused.value = true
}

const resumeProgress = () => {
    if (paused.value) {
        paused.value = false;
        startTime.value = performance.now() - (progress.value / 100) * duration.value;
        animateProgress();
      }
}

const animateProgress = () => {
       const animate = (time) => {
        if (!startTime.value) startTime.value = time;

        const progressTime = time - startTime.value;
        progress.value = Math.min((progressTime / duration.value) * 100, 100);

        if (progressTime < duration.value && !paused.value) {
          animationId.value = requestAnimationFrame(animate);
        } else {
          startTime.value = null; // Reset start time when animation completes
          paused.value = false;
          if(mediaIndex.value < mediaIndexMax.value - 1 ){
            mediaIndex.value++;
          }else{
            mediaIndex.value = 0
          }
        console.log(mediaIndex.value)
        startProgress()
         
        }
      };

      animationId.value = requestAnimationFrame(animate);
}

const restartAnimation = () => {
      pauseProgress();
      progress.value = 0; // Reset progress if starting a new progress
      paused.value = false
      startTime.value = 0
      animateProgress()
}

const next = () => {
    if(mediaIndex.value < mediaIndexMax.value - 1){
        mediaIndex.value++;
    }else{
        mediaIndex.value = 0
    }
    restartAnimation()
}

const prev = () => {
     if(mediaIndex.value > 0){
        mediaIndex.value--;
    }else{
        mediaIndex.value = mediaIndexMax.value - 1
    }
    restartAnimation()
}

const getFileType = (fileType) => {
    const lowercaseFileType = fileType.toLowerCase();

    if (lowercaseFileType.includes('image')) {
        return 'image';
    } else if (lowercaseFileType.includes('video')) {
        return 'video';
    } else {
        return 'unknown';
    }
}


const loadProfile = () => {
    axios.get('/api/profile/'+ route.params.id +'/show').then((res) => {
        profile.value = res.data;
        media.value = res.data.media;
        mediaIndexMax.value = media.value.length
        if(profile.value.password != ''){
            showPasseord.value = true
        }else{
            startProgress();
        }
        
    }).catch((err) => {
        console.log(err)
        router.push('/login')
    })
}

onMounted(() => {
    // startProgress()
    loadProfile()

})

</script>