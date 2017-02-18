// main.js

import Vue from 'vue'
import Resource from 'vue-resource'
import Router from 'vue-router'

import App from './App.vue'
import Home from './components/Home.vue'
import Login from './components/Login.vue'

// install router
Vue.use(Router)

Vue.use(Resource)
Vue.http.options.root = "http://localhost"

// routing
var router = new Router({
	mode: "history",
	routes: [
		{
			name: 'home',
			path: '/home/',
			component: Home
		},
		{
			name : 'login',
			path: '/login/',
			component: Login
		},
		{
			path: '*',
			redirect: '/home'
		}
	]
})

const app = new Vue({
  router,
  render: (h) => h(App)
}).$mount('#app')

