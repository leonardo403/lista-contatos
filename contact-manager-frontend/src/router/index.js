import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import ContactsView from '../views/ContactsView.vue'
import ContactDetailView from '../views/ContactDetailView.vue'

const routes = [
  { path: '/', redirect: '/contacts' },
  { path: '/login', component: LoginView },
  { path: '/register', component: RegisterView },
  { path: '/contacts', component: ContactsView },
  { path: '/contacts/new', component: ContactDetailView },
  { path: '/contacts/:id', component: ContactDetailView },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
