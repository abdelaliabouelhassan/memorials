import { createRouter, createWebHistory } from 'vue-router'

//componentes

import Index from '@/components/pages/index.vue'
import Login from '@/components/pages/auth/Login.vue'

const routes = [
  { path: '/', component: Index, name: 'index' },
  { path: '/login', component: Login, name: 'login' },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;