
import './bootstrap';
import { createApp } from 'vue';

import { createPinia } from 'pinia'
const pinia = createPinia()



import MainApp from '@/components/app.vue'
const app = createApp(MainApp);

import router from '@/router/routes.js'
import './axios/auth'

app
.use(pinia)
.use(router)
.mount('#app');
