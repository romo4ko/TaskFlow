<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";

const data = ref();
const tasks = ref();
const router = useRouter();

const form = ref({
  name: null,
  description: null,
  status: 0,
  type: null,
  done: 0,
  project_id: null,
  parent_id: null,
  employee_ids: [],
  date_start: null,
  date_end: null
})

axios.get('/api/getTaskForm').then((response) => {
  console.log(response)
  data.value = response.data
})

function fetchTasks() {
  axios.get('/api/tasks', {
    params: {
      project_id: form.value.project_id
    }
  }).then((response) => {
    tasks.value = response.data.data
  })
}

function save() {
  axios.post('/api/tasks', form.value).then((response) => {
    if (response.data.status == 0) {
      alert('Сохранено');
      router.push('/tasks')
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
      <h1>Создать задачу</h1>
    </div>
    <div>
        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
              <strong class="mt-2">Название задачи*:</strong>
              <input v-model="form.name" type="text" name="type" class="form-control mt-2" placeholder="Название задачи">
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
              <strong class="mt-2">Описание задачи:</strong>
              <textarea v-model="form.description" type="text" name="type" class="form-control mt-2" placeholder="Описание задачи"></textarea>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-6">
              <div class="form-group">
                <strong>Проект*:</strong>
                <select v-if="data" v-model="form.project_id" @change="fetchTasks()" class="form-select mt-2">
                  <option v-for="(item, index) in data.projects" :value="item.id">{{ item.name }}</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <strong>Родительская задача:</strong>
                <select v-if="data" :disabled="form.project_id == null && !tasks" v-model="form.parent_id" class="form-select mt-2">
                  <option v-for="(item, index) in tasks" :value="item.id">{{ item.name }}</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-6 mb-2">
              <div class="form-group">
                <strong>Назначена:</strong>
                <select v-if="data" v-model="form.employee_ids" class="form-select mt-2" multiple aria-label="Multiple select example">
                  <option v-for="(item, index) in data.employees" :value="item.id">{{ item.name }}</option>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <strong>Выполнена (%):</strong>
                <input v-model="form.done" type="number" class="form-control mt-2" min="0" max="100" step="10">
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-6 mb-2">
              <div class="form-group">
                <strong>Статус задачи:</strong>
                <select v-if="data" v-model="form.status" class="form-select mt-2">
                  <option v-for="(item, index) in data.statuses" :value="index">{{ item }}</option>
                </select>
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <strong>Тип задачи:</strong>
                <select v-if="data" v-model="form.type" class="form-select mt-2">
                  <option v-for="(item, index) in data.types" :value="index">{{ item }}</option>
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
