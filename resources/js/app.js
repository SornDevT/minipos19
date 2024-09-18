import './bootstrap';


import { createApp } from 'vue';
import router from './Router';
import App from './App.vue';
import Menu from './Components/Menu.vue';


const app = createApp(App);
app.use(router);
app.component('Menu',Menu);
app.mount('#vue-app');
