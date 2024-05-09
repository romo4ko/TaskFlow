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
  {
    name: 'ProjectDetail',
    path: '/project/:id',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Projects/ProjectDetail.vue')
  },
  {
    name: 'CreateProject',
    path: '/project/create',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Projects/ProjectCreate.vue')
  },
  {
    name: 'EditProject',
    path: '/project/edit/:id',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Projects/ProjectEdit.vue')
  },
  {
    name: 'Tasks',
    path: '/tasks',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Tasks/TasksList.vue')
  },
  {
    name: 'TaskDetail',
    path: '/task/:id',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Tasks/TaskDetail.vue')
  },
  {
    name: 'CreateTasks',
    path: '/task/create',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Tasks/TaskCreate.vue')
  },
  {
    name: 'EditTasks',
    path: '/task/edit/:id',
    meta: {
      onlyGuests: false,
    },
    component: () => import('@/views/Tasks/TaskEdit.vue')
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router
