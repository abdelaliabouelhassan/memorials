import { createRouter, createWebHistory } from 'vue-router'
import {requireAuth} from '../middleware/auth'
import {Auth} from '../middleware/authpage'
//componentes

import Index from '@/components/pages/index.vue'
import SocialLogin from '@/components/pages/auth/SocialLogin.vue'
import Login from '@/components/pages/auth/Login.vue'
import Register from '@/components/pages/auth/Register.vue'
import Profile from '@/components/pages/profile/index.vue'
import ProfileId from '@/components/pages/profile/id.vue'

const routes = [
  { path: '/', component: Index, name: 'index' },
  {path: '/social-login/:token',component: SocialLogin, name: 'social-login'},
  { path: '/login', component: Login, name: 'login',beforeEnter: Auth },
  { path: '/register', component: Register, name: 'register',beforeEnter: Auth },
  { path: '/profile', component: Profile, name: 'profile', beforeEnter: requireAuth },
  { path: '/profile/:id', component: ProfileId, name: 'profile-id' },
 
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;