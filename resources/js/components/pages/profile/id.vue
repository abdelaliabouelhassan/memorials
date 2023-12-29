<template>
  <MainLayouts theme='dark' class="">
    <div>
        <img src="https://thumbs.dreamstime.com/b/m%C4%99%C5%BCczyzna-stary-17599452.jpg" class="  w-full h-full bg-cover absolute top-0 left-0 " alt="">
    </div>
    <div class=" w-full h-full z-10 relative backdrop-blur-xl py-4 px-4 space-y-8 ">
         <div class=" w-full max-w-sm mx-auto">
            <div class="w-full flex items-center space-x-4">
            <button>
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
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
         </div>
         </div>

         <div class=" w-full rounded-md bg-gray-400 h-3/4 shadow-2xl overflow-hidden">
            <img src="https://thumbs.dreamstime.com/b/m%C4%99%C5%BCczyzna-stary-17599452.jpg" class=" w-full h-full object-cover" alt="">
         </div>
    </div>

    <BottomSheet />
  </MainLayouts>
</template>


<script setup>
import MainLayouts from "@/components/layouts/Default.vue";
import BottomSheet from '@/components/partials/UI/BottomSheet.vue'
import { onMounted, ref } from "vue";


const duration = ref(5000); //5s
const progress = ref(0)
const animationId = ref(null)
const startTime = ref(null)
const paused = ref(false)

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
          alert('gg')
        }
      };

      animationId.value = requestAnimationFrame(animate);
}

onMounted(() => {
    startProgress()
})

</script>