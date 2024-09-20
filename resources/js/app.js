import './bootstrap';


import { createApp } from 'vue';
import router from './Router';
import App from './App.vue';
import Menu from './Components/Menu.vue';

import { createPinia } from 'pinia'
const pinia = createPinia()


const app = createApp(App);
app.use(pinia);
app.use(router);
app.component('Menu',Menu);
app.mount('#vue-app');
