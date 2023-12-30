
import './bootstrap';
import { createApp } from 'vue';

import MainApp from '@/components/app.vue'
const app = createApp(MainApp);

import router from '@/router/routes.js'
import './axios/auth'

app
.use(router)
.mount('#app');
