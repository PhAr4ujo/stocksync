import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router';
import store from './store';
import '../css/app.css'; 

createApp(App).use(router).use(store).mount('#app');
