import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {createApp} from 'vue'
import {createPinia} from 'pinia'
import router from './router';
import AppComponent from "./App.vue";
import {authStore} from "@/stores/authStore";

import 'bootstrap';

const app = createApp(AppComponent)
app.use(createPinia())

// Check auth
router.beforeEach((to) => {
  const auth = authStore();
  if (to.meta.requiresAuth && !auth.userData) {
    return '/login'
  }

  if (auth.userData) {
    if (to.meta.forAdmin && auth.userData.user.grants.slug !== 'administrator') {
      return '/'
    }

    if (to.meta.forManager && (auth.userData.user.grants.slug !== 'manager' && auth.userData.user.grants.slug !== 'administrator')) {
      return '/'
    }
  }

  // Redirect authorized users from guest pages
  if (to.meta.onlyGuests && auth.userData) {
    return '/'
  }
})

const auth = authStore();

// Checking auth and mount app
auth.checkAuth()
  .finally(() => {
    app.use(router)
    app.mount('#app')
  });
