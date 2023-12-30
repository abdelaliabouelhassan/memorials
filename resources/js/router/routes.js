import { createRouter, createWebHistory } from 'vue-router'
import {requireAuth} from '../middleware/auth'
//componentes

import Index from '@/components/pages/index.vue'
import Login from '@/components/pages/auth/Login.vue'
import Register from '@/components/pages/auth/Register.vue'
import Profile from '@/components/pages/profile/index.vue'
import ProfileId from '@/components/pages/profile/id.vue'

const routes = [
  { path: '/', component: Index, name: 'index' },
  { path: '/login', component: Login, name: 'login' },
  { path: '/register', component: Register, name: 'register' },
  { path: '/profile', component: Profile, name: 'profile', beforeEnter: requireAuth },
  { path: '/profile/:id', component: ProfileId, name: 'profile-id' },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;