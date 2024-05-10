<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";

const data = ref();
const router = useRouter();
const route = useRoute();

const form = ref({
  name: null,
  email: null,
  phone: null,
  password: '',
  job_id: null,
})

axios.get('/api/users/' + route.params.id).then((response) => {
  form.value = {
    name: response.data.data.name,
    email: response.data.data.email,
    phone: response.data.data.phone,
    password: null,
    job_id: response.data.data.job ? response.data.data.job.id : null,
  }
})

axios.get('/api/getUserForm').then((response) => {
  data.value = response.data
})

function save() {
  console.log(form.value)
  axios.put(`/api/users/${ route.params.id }`, form.value).then((response) => {
    if (response.data.status == 0) {
      alert('Изменено');
      router.push('/users')
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
      <h1>Изменить данные сотрудника</h1>
    </div>
    <div>
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
          <div class="form-group">
            <strong class="mt-2">ФИО*:</strong>
            <input v-model="form.name" type="text" name="type" class="form-control mt-2" placeholder="ФИО*">
          </div>
        </div>

        <div class="row row-cols-2 mb-2">
          <div class="col">
            <div class="form-group">
              <strong class="mt-2">Email*:</strong>
              <input v-model="form.email" type="text" name="type" class="form-control mt-2" placeholder="Email*"/>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <strong class="mt-2">Телефон:</strong>
              <input v-model="form.phone" type="text" name="type" class="form-control mt-2" placeholder="Телефон"/>
            </div>
          </div>
        </div>

        <div class="row row-cols-2 mb-2">
          <div class="col mb-2">
            <div class="form-group">
              <strong>Должность*:</strong>
              <select v-if="data" v-model="form.job_id" class="form-select mt-2">
                <option v-for="(item, index) in data.jobs" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <strong class="mt-2">Изменить пароль:</strong>
              <input v-model="form.password" type="password" name="password" class="form-control mt-2" placeholder="Пароль"/>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
          <button @click="save()" class="btn btn-primary">Сохранить</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
