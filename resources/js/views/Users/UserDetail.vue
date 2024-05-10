<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";

const data = ref();
const router = useRouter();

axios.get('/api/users/' + useRoute().params.id).then((response) => {
  console.log(response)
  data.value = response.data.data
})

</script>

<template>
  <div class="container mt-3">
    <div class="d-flex align-content-center">
      <span @click="router.back()" class="d-flex align-items-center pe-4 mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
      </span>
      <h1 v-if="data">Сотрудник {{data.name}}</h1>
    </div>
    <div v-if="data">
      <h4>Email</h4>
      <p>{{ data.email }}</p>
      <h4>Телефон</h4>
      <p>{{ data.phone ?? 'Нет' }}</p>
      <div class="row row-cols-2" v-if="data.job">
        <div class="col">
          <h4>Должность</h4>
          <p>{{ data.job.name }}</p>
        </div>
        <div class="col">
          <h4>Права</h4>
          <p>{{ data.grants.name }}</p>
        </div>
      </div>
      <h4>Дата добавления</h4>
      <p>{{ data.created_at }}</p>
    </div>
    <div v-else>Сотрудник не найден</div>
  </div>
</template>

<style scoped>

</style>
