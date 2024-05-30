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
      requiresAuth: true,
    },
    component: () => import('@/views/Projects/ProjectsList.vue')
  },
  {
    name: 'ProjectDetail',
    path: '/project/:id',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/Projects/ProjectDetail.vue')
  },
  {
    name: 'CreateProject',
    path: '/project/create',
    meta: {
      requiresAuth: true,
      forAdmin: true,
    },
    component: () => import('@/views/Projects/ProjectCreate.vue')
  },
  {
    name: 'EditProject',
    path: '/project/edit/:id',
    meta: {
      requiresAuth: true,
      forAdmin: true,
    },
    component: () => import('@/views/Projects/ProjectEdit.vue')
  },
  {
    name: 'Tasks',
    path: '/tasks',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/Tasks/TasksList.vue')
  },
  {
    name: 'TaskDetail',
    path: '/task/:id',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/Tasks/TaskDetail.vue')
  },
  {
    name: 'CreateTasks',
    path: '/task/create',
    meta: {
      requiresAuth: true,
      forManager: true
    },
    component: () => import('@/views/Tasks/TaskCreate.vue')
  },
  {
    name: 'EditTasks',
    path: '/task/edit/:id',
    meta: {
      requiresAuth: true,
    },
    component: () => import('@/views/Tasks/TaskEdit.vue')
  },
  {
    name: 'Users',
    path: '/users',
    meta: {
      requiresAuth: true,
      forAdmin: true,
    },
    component: () => import('@/views/Users/UsersList.vue')
  },
  {
    name: 'UserDetail',
    path: '/user/:id',
    meta: {
      requiresAuth: true,
      forAdmin: true,
    },
    component: () => import('@/views/Users/UserDetail.vue')
  },
  {
    name: 'CreateUsers',
    path: '/user/create',
    meta: {
      requiresAuth: true,
      forAdmin: true,
    },
    component: () => import('@/views/Users/UserCreate.vue')
  },
  {
    name: 'EditUsers',
    path: '/user/edit/:id',
    meta: {
      requiresAuth: true,
      forAdmin: true,
    },
    component: () => import('@/views/Users/UserEdit.vue')
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router
