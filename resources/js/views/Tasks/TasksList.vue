<script setup lang="ts">

import axios from "axios";
import {onMounted, ref} from "vue";
import {authStore} from "@/stores/authStore";

const data = ref();
const projects = ref();
const project = ref();

const auth = authStore();
const role = ref(auth.userData ? auth.userData.user.grants.slug : null);

function fetchProjects() {
  axios.get('/api/projects').then((response) => {
    projects.value = response.data.data
  })
}
fetchProjects()

onMounted(() => {
  let project_id = localStorage.getItem('project') ?? null
  if (project_id) {
    project.value = project_id
    fetchTasks()
  }
})

function fetchTasks() {
  localStorage.setItem('project', project.value);

  axios.get('/api/tasks', {
  params: {
    project_id: project.value
  }
}).then((response) => {
    data.value = response.data.data
    console.log(data.value)

  })
}

function destroy(id: number) {
  if (confirm('Удалить?')) {
    axios.delete('/api/tasks/'+id).then((response) => {
      console.log(response)
      fetchTasks()
    })
  }
}

</script>

<template>
  <div class="container mt-3">
    <h1>Задачи</h1>

    <div>
      <div class="col-4 my-3">
        <div class="form-group">
          <strong v-if="!project">Выберите проект:</strong>
          <strong v-else>Проект:</strong>
          <select v-if="projects" v-model="project" class="form-select mt-2" @change="fetchTasks()" aria-label="Статус">
            <option v-for="(item) in projects" :value="item.id">{{ item.name }}</option>
          </select>
        </div>
      </div>
    </div>

    <div>
      <div class="row" v-if="role == 'administrator' || role == 'manager'">
        <div class="col-lg-12 my-2">
          <div>
            <router-link to="/task/create" class="btn btn-success">Создать задачу</router-link>
          </div>
        </div>
      </div>

      <table class="table table-bordered" v-if="data && data.length">
        <tr>
          <th>#</th>
          <th>Название</th>
          <th>Статус</th>
          <th>Тип</th>
          <th>Выполнено</th>
          <th>Дата начала</th>
          <th>Дата окончания</th>
        </tr>
        <tr v-for="(item, index) in data">
          <td>{{ item.id }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.status.name }}</td>
          <td>{{ item.type ? item.type.name : '-' }}</td>
          <td>{{ item.done }}%</td>
          <td>{{ item.date_start }}</td>
          <td>{{ item.date_end ?? '-' }}</td>
          <td class="d-flex justify-content-around">
            <div>
              <router-link class="btn btn-info" :to="'/task/'+item.id">Просмотр</router-link>
            </div>
            <div v-if="role == 'administrator' || role == 'manager'">
              <router-link class="btn btn-primary" :to="'/task/edit/'+item.id">Изменить</router-link>
            </div>
            <div v-if="role == 'administrator' || role == 'manager'">
              <a class="btn btn-danger" @click="destroy(item.id)">Удалить</a>
            </div>
          </td>
        </tr>
      </table>
      <h5 v-else-if="!project">Выберите проект</h5>
      <h5 v-else>Список пуст</h5>
    </div>
  </div>
</template>

<style scoped>

</style>
