<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";

const data = ref();
const router = useRouter();

axios.get('/api/tasks/' + useRoute().params.id).then((response) => {
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
      <h1 v-if="data">Задача #{{data.id}} {{data.name}}</h1>
    </div>
    <div v-if="data">
      <h4>Описание</h4>
      <p>{{ data.description ?? 'Не установлено' }}</p>

      <div class="row row-cols-2">
        <div class="col">
          <h4>Проект</h4>
          <p>{{ data.project.name }}</p>
        </div>
        <div class="col">
          <h4>Выполнено</h4>
          <p>{{ data.done }}%</p>
        </div>

        <div class="col">
          <h4>Статус задачи</h4>
          <p>{{ data.status.name }}</p>
        </div>
        <div class="col">
          <h4>Тип задачи</h4>
          <p>{{ data.type ? data.type.name : '-' }}</p>
        </div>
      </div>

      <div v-if="data.parent">
        <h4>Родительская задача</h4>
        <p>#{{ data.parent.id }} {{ data.parent.name }}</p>
      </div>

      <div class="row row-cols-2">
        <div class="col">
          <h4>Дата начала</h4>
          <p>{{ data.date_start }}</p>
        </div>
        <div class="col">
          <h4>Дата окончания</h4>
          <p>{{ data.date_end ?? 'Не установлено' }}</p>
        </div>
      </div>


    </div>
    <div v-else>Проект не найден</div>
  </div>
</template>

<style scoped>

</style>
