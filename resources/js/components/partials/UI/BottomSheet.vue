<template>
    <div class=" w-full z-10 rounded-t-2xl  border-t border-white  absolute bottom-0 duration-300 transition-all backdrop-blur-xl ease-in-out" :class="{'h-3/4':open,' h-[6rem] ':!open}">
        <div class=" w-full  relative p-4">
            <button @click="openSheet" class=" w-full absolute -top-1 left-0 flex cursor-pointer">
                <div class=" m-auto h-2 w-20 rounded-full bg-white"></div>
            </button>
            <div @click="openSheet" class=" w-full flex space-x-2 items-center cursor-pointer">
                <div class=" w-14 h-14 rounded-full border  overflow-hidden">

                </div>
                <div class=" flex flex-col items-start -space-y-1">
                    <span class=" text-white uppercase font-Altivo text-xl font-medium">MAX MUSTERMANN</span>
                    <span class=" text-white font-Inter text-base">☨ 22.01.1950 - 19.12.2023</span>
                </div>
            </div>

            <div class=" absolute bottom-4 right-4 space-x-2">
                <button v-if="!open">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-white">
                        <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                        <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                    </svg>
                </button>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-white" :class="{'w-14 h-14':open}">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                    </svg>
                </button>
            </div>
        </div>

     <div class=" w-full h-full px-4" v-if="open">
       <div class=" w-full h-[70%] md:h-[80%] overflow-y-auto bg-red-400">
         <div class=" w-full p-4 space-y-4">
            <p class=" text-white text-lg font-Altivo font-normal">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos reprehenderit quasi iusto iste, vero dolores,
                pariatur odio hic rem quod provident praesentium blanditiis, voluptatibus velit? Est quidem ipsa quo doloribus!
            </p>
             <p v-for="n in 10" :key="n" class=" text-white text-lg font-Altivo font-normal">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos reprehenderit quasi iusto iste, vero dolores,
                pariatur odio hic rem quod provident praesentium blanditiis, voluptatibus velit? Est quidem ipsa quo doloribus!
                pariatur odio hic rem quod provident praesentium blanditiis, voluptatibus velit? Est quidem ipsa quo doloribus!
            </p>
        </div>
       </div>

       <div class=" w-full  flex">
        <div class=" flex items-center pt-3 sm:pt-5 space-x-4 m-auto">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
            </button>
             <button>
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-white">
                        <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                        <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                    </svg>
                </button>
        </div>
       </div>
     </div>
    </div>
</template>


<script setup>
import { ref } from "vue";

 const open = ref(false)
 const openSheet = () => {
    open.value = !open.value
 }
</script>