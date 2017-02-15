import Vue from 'vue'
import Router from 'vue-router'
import Hello from 'components/Hello'
import HomeConnected from 'views/HomeConnected'
import HomeNoConnected from 'views/HomeNoConnected'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/home/connected',
      name: 'HomeConnected',
      component: HomeConnected
    },
    {
      path: '/home/noConnected',
      name: 'HomeNoConnected',
      component: HomeNoConnected
    }
  ]
})
