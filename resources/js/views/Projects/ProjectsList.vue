<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";

const data = ref();

function fetchData() {
  axios.get('/api/projects').then((response) => {
    console.log(response)
    data.value = response.data.data
  })
}
fetchData()

function destroy(id: number) {
  axios.delete('/api/projects/'+id).then((response) => {
    console.log(response)
    fetchData()
  })
}

</script>

<template>
  <div class="container mt-3">
    <h1>Проекты</h1>
    <div>
      <div class="row">
        <div class="col-lg-12 my-2">
          <div>
            <router-link to="/project/create" class="btn btn-success" href="">Создать проект</router-link>
          </div>
        </div>
      </div>

      <table class="table table-bordered" v-if="data">
        <tr>
          <th>Название</th>
          <th>Статус</th>
          <th>Руководитель</th>
          <th>Дата начала</th>
          <th>Дата окончания</th>
        </tr>
        <tr v-for="(item, index) in data">
          <td>{{ item.name }}</td>
          <td>{{ item.status.name }}</td>
          <td>{{ item.pm.name }}</td>
          <td>{{ item.date_start }}</td>
          <td>{{ item.date_end ?? '-' }}</td>
          <td class="d-flex justify-content-around">
            <div>
              <router-link class="btn btn-info" :to="'/project/'+item.id">Просмотр</router-link>
            </div>
            <div>
              <router-link class="btn btn-primary" :to="'/project/edit/'+item.id">Изменить</router-link>
            </div>
            <div>
              <a class="btn btn-danger" @click="destroy(item.id)">Удалить</a>
            </div>
          </td>
        </tr>
      </table>
      <h5 v-else>Список пуст</h5>
    </div>
  </div>
</template>

<style scoped>

</style>
