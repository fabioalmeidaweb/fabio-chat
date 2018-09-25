require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router'
import routes from './routes'
import axios from 'axios'

Vue.use(VueRouter)
const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
  let requiresAuth = to.meta.requiresAuth || false;

  if (requiresAuth) {
    return axios.get('api/vi/users/me').then((res) => {
      if (res.data.id === undefined) {
        return next({path: 'login'});
      }
      return next();
    })
  }

  return next();
})

new Vue({
  el: '#app',
  template: '<div><router-view class="container"></router-view></div>',
  router
});

$(document).ready(function(){
    $('#nav-mobile').sideNav({
        edge: 'right'
    });
});
