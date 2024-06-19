import { defineNuxtConfig } from 'nuxt/config';

export default defineNuxtConfig({
  devtools: {
    enabled: false
  },
  modules: ['@element-plus/nuxt'],
  rootDir: '.',
  srcDir: './src',
  dir: {
    app: "app",
    pages: "routes",
  },
  pages: true,
  css: ['@/shared/assets/css/index.css']
})
