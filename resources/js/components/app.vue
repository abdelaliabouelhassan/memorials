<template>
    <div class=" w-full">
        <router-view></router-view>
    </div>
</template>


<script setup>
 import axios from "axios";
 import { useStore } from "@/stores/states.js"
 import { onMounted } from "vue";
 import { useRouter,useRoute } from 'vue-router';
 const router = useRouter();
 const route = useRoute()
 const store = useStore();
 const getUser = () => {
    axios.get('/user').then((res) => {
        console.log(res)
        store.user = res.data
    }).catch((error) => {  
        if(route.path == '/') 
          router.push('/')  
    })
 }

  const getQrCodeStatus = () => {
    axios.get('/qrcode-status').then((res) => {
        console.log(res.data)
        if(res.data == 'assigned'){
           store.qrcode_assiged = true;
        }else if(res.data == 'claimed'){
            store.qrcode_claimed = true;
        }
    }).catch((error) => {  
       console.log(error) 
    })
 }

 onMounted(() => {
         getUser()
         getQrCodeStatus();
 })

</script>