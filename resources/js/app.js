
import './bootstrap';
import { createApp } from 'vue';

import { createPinia } from 'pinia'
const pinia = createPinia()

import router from '@/router/routes.js'
import './axios/auth'
import { createI18n } from 'vue-i18n'
import MainApp from '@/components/app.vue'




const app = createApp(MainApp);

import enLocale from './lang/en.json'
import deLocale from './lang/de.json'
const i18n = createI18n({
    locale: 'de',
    messages: {
      en: enLocale,
      de:deLocale
      // Add more languages as needed
    },
});

app
.use(pinia)
.use(router)
.use(i18n)
.mount('#app');
