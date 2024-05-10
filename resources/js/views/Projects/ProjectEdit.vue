<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";

const data = ref();
const router = useRouter();
const route = useRoute();

const form = ref({
  name: null,
  description: null,
  extended: null,
  status: 0,
  pm_id: null,
  date_start: null,
  date_end: null
})

axios.get('/api/projects/' + route.params.id).then((response) => {
  form.value = {
    name: response.data.data.name,
    description: response.data.data.description,
    extended: response.data.data.extended,
    status: response.data.data.status.id,
    pm_id: response.data.data.pm.id,
    date_start: response.data.data.date_start,
    date_end: response.data.data.end
  }
})

axios.get('/api/getProjectForm').then((response) => {
  data.value = response.data
})

function save() {
  axios.put(`/api/projects/${ route.params.id }`, form.value).then((response) => {
    if (response.data.status == 0) {
      alert('Изменено');
      router.push('/projects')
    }
  }).catch((error) => {
    console.log(Object.keys(error.response.data.errors))
    alert(error.response.statusText)
  })
}

</script>

<template>
  <div class="container mt-3">
    <div class="d-flex align-content-center">
      <span @click="router.back()" class="d-flex align-items-center pe-4 mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
      </span>
      <h1 v-if="data">Изменить проект</h1>
    </div>
    <div>
      <div class="row" v-if="data">

        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
          <div class="form-group">
            <strong class="mt-2">Название проекта*:</strong>
            <input v-model="form.name" type="text" name="type" class="form-control mt-2" placeholder="Название проекта*">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
          <div class="form-group">
            <strong class="mt-2">Описание проекта:</strong>
            <textarea v-model="form.description" type="text" name="type" class="form-control mt-2" placeholder="Описание проекта"></textarea>
          </div>
        </div>

        <div class="col-12 mb-2">
          <div class="form-group">
            <strong class="mt-2">Дополнительное описание проекта:</strong>
            <textarea v-model="form.extended" type="text" name="type" class="form-control mt-2" placeholder="Дополнительное описание проекта"></textarea>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-6 mb-2">
            <div class="form-group">
              <strong>Статус проекта:</strong>
              <select v-if="data" v-model="form.status" class="form-select mt-2" aria-label="Статус">
                <option v-for="(item, index) in data.statuses" :value="index">{{ item }}</option>
              </select>
            </div>
          </div>
          <div class="col-6 mb-2">
            <div class="form-group">
              <strong>Менеджер проекта*:</strong>
              <select v-if="data" v-model="form.pm_id" class="form-select mt-2" aria-label="">
                <option v-for="(item, index) in data.managers" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-6">
            <div class="form-group">
              <strong>Дата начала:</strong>
              <input v-model="form.date_start" type="date" name="term" class="form-control mt-2" placeholder="Дата начала">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <strong>Дата окончания:</strong>
              <input v-model="form.date_end" type="date" name="term" class="form-control mt-2" placeholder="Дата окончания">
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
        <button @click="save()" class="btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
