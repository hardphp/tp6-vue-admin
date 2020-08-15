import Vue from 'vue'
import Cookies from 'js-cookie'
import ElementUI from 'element-ui';
import './styles/element-variables.scss'
import '@/styles/index.scss' // global css

import App from './App.vue'
import router from './router'
import store from './store'

import './icons' // icon
import './permission' // permission control

Vue.config.productionTip = false
Vue.use(ElementUI, {
  size: Cookies.get('size') || 'medium' // set element-ui default size
})

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
