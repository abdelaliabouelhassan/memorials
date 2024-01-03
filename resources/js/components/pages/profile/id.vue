<template>
  <MainLayouts theme='dark' class="">
    <div v-if="mediaIndexMax > 0">
        <img v-if="getFileType(media[mediaIndex].type) == 'image'" :src="media[mediaIndex].path" class="  w-full h-full object-cover absolute top-0 left-0 " alt="">
        <video v-if="getFileType(media[mediaIndex].type) == 'video'" :src="media[mediaIndex].path" class=" w-full h-full absolute object-cover" muted autoplay></video>
    </div>
    <div class=" w-full h-full z-10 relative backdrop-blur-xl py-4 px-4 space-y-8 ">
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

const profile = ref([])
const media = ref([])
const mediaIndex = ref(0)
const mediaIndexMax = ref(0)
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
        startProgress();
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