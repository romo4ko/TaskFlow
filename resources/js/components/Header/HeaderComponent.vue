<script setup lang="ts">

import axios from "axios";
import {authStore} from "@/stores/authStore";
import router from "@/router";
import {ref, watch} from "vue";
import {useRoute} from "vue-router";

const route = useRoute();

function logout() {
  axios.post('/api/logout')
    .then(() => {
        location.href = '/';
    })
}

const active = ref('main');

</script>

<template>
  <header>
    <nav class="navbar navbar-dark bg-dark sticky-top navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">TaskFlow</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link to="/" class="nav-link" :class="active == 'main' ? 'active' : ''" aria-current="page" @click="active = 'main'" href="#">Главная</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/projects" class="nav-link" :class="active == 'projects' ? 'active' : ''" aria-current="page" @click="active = 'projects'" href="#">Проекты</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/tasks" class="nav-link" :class="active == 'tasks' ? 'active' : ''" aria-current="page" @click="active = 'tasks'" href="#">Задачи</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/users" class="nav-link" :class="active == 'users' ? 'active' : ''" aria-current="page" @click="active = 'users'" href="#">Сотрудники</router-link>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Профиль
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" @click.prevent="logout()">Выйти</a></li>
                <li><a class="dropdown-item" href="#">Изменить</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">О приложении</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Поиск</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
</template>

<style scoped>

</style>
