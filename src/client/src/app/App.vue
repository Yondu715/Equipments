<script setup lang="ts">
import { onMounted } from 'vue';
import { RouterView, useRouter } from 'vue-router'
import { setRouter } from '~/shared/routing';
import '~/shared/assets/css/index.css';

const router = useRouter();
onMounted(() => setRouter(router));
</script>

<template>
  <RouterView />
</template>
