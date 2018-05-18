
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Vue Plugins
import Auth from './packages/auth/Auth.js';
Vue.use(Auth);

import router from './routes.js';

const app = new Vue({
  router
}).$mount('#app')
