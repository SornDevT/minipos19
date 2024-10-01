import './bootstrap';


import { createApp } from 'vue';
import router from './Router';
import App from './App.vue';
import Menu from './Components/Menu.vue';
import Pagination from './Components/Pagination.vue';

import { createPinia } from 'pinia';
const pinia = createPinia();

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


const app = createApp(App);
app.use(pinia);
app.use(router);
app.component('Menu',Menu);
app.component('Pagination',Pagination);
app.use(VueSweetalert2);
app.mount('#vue-app');
