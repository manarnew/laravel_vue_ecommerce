import './output.css'
import store from './store'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
createApp(App)
.use(store)
.use(router)
.mount('#app')
