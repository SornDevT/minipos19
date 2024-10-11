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

import Cleave from 'vue-cleave-component';

import { PerfectScrollbarPlugin } from 'vue3-perfect-scrollbar';
import 'vue3-perfect-scrollbar/style.css';

import DashGrap from './Components/DashGrap.vue';


const app = createApp(App);
app.use(pinia);
app.use(router);
app.use(Cleave);
app.use(PerfectScrollbarPlugin);
app.component('Menu',Menu);
app.component('Pagination',Pagination);
app.component('DashGrap',DashGrap);
app.use(VueSweetalert2);
app.mount('#vue-app');
