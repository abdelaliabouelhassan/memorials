import { createRouter, createWebHistory } from 'vue-router'
import {requireAuth} from '../middleware/auth'
import {Auth} from '../middleware/authpage'
//componentes

import Index from '@/components/pages/index.vue'
import Login from '@/components/pages/auth/Login.vue'
import Register from '@/components/pages/auth/Register.vue'
import Profile from '@/components/pages/profile/index.vue'
import ProfileId from '@/components/pages/profile/id.vue'
import CreateProfile from '@/components/pages/profile/create/index.vue'
import ProfileComments from '@/components/pages/profile/comments/index.vue'
const routes = [
  { path: '/', component: Index, name: 'index' },
  { path: '/login', component: Login, name: 'login',beforeEnter: Auth },
  { path: '/register', component: Register, name: 'register',beforeEnter: Auth },
  { path: '/profile', component: Profile, name: 'profile', beforeEnter: requireAuth },
  { path: '/profile/:id', component: ProfileId, name: 'profile-id' },
  { path: '/profile/:id/edit', component: CreateProfile, name: 'profile-create' },
  { path: '/profile/:id/comments', component: ProfileComments, name: 'profile-comments' },
 
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router;