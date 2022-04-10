import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import store from './store'
import "./plugins/bootstrap-vue";

createApp(App).use(store).mount('#app')
