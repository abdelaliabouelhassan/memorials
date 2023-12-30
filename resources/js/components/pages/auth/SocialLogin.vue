<template>
    Redirecting...
</template>


<script setup>
import { onMounted } from 'vue';
import { useRouter,useRoute } from 'vue-router';
const router = useRouter()
const route = useRoute()

onMounted(() => {
    const token = route.params.token;
    if(token){
        localStorage.setItem('token',token)
    }

    setTimeout(() => {
        window.location.href = '/profile'
    },1000)
})
</script>