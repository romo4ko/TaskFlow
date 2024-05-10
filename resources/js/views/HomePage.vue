<script setup lang="ts">

import {ref} from "vue";
import {authStore} from "@/stores/authStore";

const auth = authStore();
const userData = ref(auth.userData ?? null);

</script>


<template>
  <div class="container mt-3">
    <h1>Главная</h1>
    <div class="row">
      <div class="my-3">
        <h5><b>TaskFlow</b> - приложение для управления проектами и задачами.</h5>
      </div>
      <div v-if="userData">
<!--        <p>Ваше имя: {{ userData.user.name }}</p>-->
        <p>Ваша роль в системе: {{ userData.user.grants.name }}</p>
      </div>
    </div>
  </div>

</template>
<script setup lang="ts">
</script>
