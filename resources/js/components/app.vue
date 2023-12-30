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
    axios.get('/api/user').then((res) => {
        store.user = res.data
    }).catch((error) => {  
        if(route.path == '/') 
          router.push('/')  
    })
 }

 onMounted(() => {
         getUser()
 })

</script>