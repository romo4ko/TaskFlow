<template>
  <div>
    <header-component></header-component>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import HeaderComponent from "@/components/Header/HeaderComponent.vue";

export default defineComponent({
  name: "App",
  components: {HeaderComponent}
});
</script>
