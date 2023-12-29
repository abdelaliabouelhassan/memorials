import { createRouter, createWebHistory } from 'vue-router'

//componentes

import Index from '@/components/pages/index.vue'
import Login from '@/components/pages/auth/Login.vue'
import Register from '@/components/pages/auth/Register.vue'
import Profile from '@/components/pages/profile/index.vue'

const routes = [
  { path: '/', component: Index, name: 'index' },
  { path: '/login', component: Login, name: 'login' },
  { path: '/register', component: Register, name: 'register' },
  { path: '/profile', component: Profile, name: 'profile' },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;