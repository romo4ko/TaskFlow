<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";

const data = ref();

function fetchData() {
  axios.get('/api/users').then((response) => {
    console.log(response)
    data.value = response.data.data
  })
}
fetchData()

function destroy(id: number) {
  if (confirm('Удалить?')) {
    axios.delete('/api/users/' + id).then((response) => {
      console.log(response)
      fetchData()
    })
  }
}

</script>

<template>
  <div class="container mt-3">
    <h1>Сотрудники</h1>
    <div>
      <div class="row">
        <div class="col-lg-12 my-2">
          <div>
            <router-link to="/user/create" class="btn btn-success" href="">Добавить сотрудника</router-link>
          </div>
        </div>
      </div>

      <table class="table table-bordered table-hover" v-if="data && data.length">
        <thead>
          <tr>
            <th>ФИО</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Должность</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data">
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td>{{ item.phone ?? '-' }}</td>
            <td>{{ item.job ? item.job.name : '-' }}</td>
            <td class="d-flex justify-content-around">
              <div>
                <router-link class="btn btn-info" :to="'/user/'+item.id">Просмотр</router-link>
              </div>
              <div>
                <router-link class="btn btn-primary" :to="'/user/edit/'+item.id">Изменить</router-link>
              </div>
              <div>
                <a class="btn btn-danger" @click="destroy(item.id)">Удалить</a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <h5 v-else>Список пуст</h5>
    </div>
  </div>
</template>

<style scoped>

</style>
