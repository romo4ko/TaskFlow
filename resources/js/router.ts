import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router";

const routes: Array<RouteRecordRaw> = [
  {
    name: 'HomePage',
    path: '/',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/HomePage.vue')
  },
  {
    name: 'Login',
    path: '/login',
    meta: {
      onlyGuests: true,
    },
    component: () => import('@/views/LoginPage.vue')
  },
  {
    name: 'Projects',
    path: '/projects',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Projects/ProjectsList.vue')
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router
