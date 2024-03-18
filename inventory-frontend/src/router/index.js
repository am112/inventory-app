import { createRouter, createWebHistory } from 'vue-router'
import ProductPage from '../views/ProductPage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ProductPage
    }
  ]
})

export default router
