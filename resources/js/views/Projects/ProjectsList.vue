<script setup lang="ts">

import axios from "axios";
import {ref} from "vue";

const data = ref();

axios.get('/api/projects').then((response) => {
  console.log(response)
  data.value = response.data.data
})

</script>

<template>
  <div class="container mt-3">
    <h1>Проекты</h1>
    <div>
      <div class="row">
        <div class="col-lg-12 my-2">
          <div>
            <a class="btn btn-success" href="">Создать проект</a>
          </div>
        </div>
      </div>

      <table class="table table-bordered" v-if="data">
        <tr>
          <th>Название</th>
          <th>Описание</th>
          <th>Статус</th>
          <th>Руководитель</th>
          <th>Дата начала</th>
          <th>Дата окончания</th>
        </tr>
        <tr v-for="(item, index) in data">
          <td>{{ item.name }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.status }}</td>
          <td>{{ item.pm_id }}</td>
          <td>{{ item.date_start }}</td>
          <td>{{ item.date_end ?? '-' }}</td>
          <td class="d-flex justify-content-around">
            <div>
              <a class="btn btn-info" href="">Просмотр</a>
            </div>
            <div>
              <a class="btn btn-primary" href="">Изменить</a>
            </div>
            <form action="" method="POST">
              <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<style scoped>

</style>
