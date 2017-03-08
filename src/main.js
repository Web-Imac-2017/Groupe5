// main.js

import Vue from 'vue'
import Resource from 'vue-resource'
import Router from 'vue-router'

import App from './App.vue'
import Home from './components/Home.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import Profil from './components/ProfilCPN.vue'
import SearchBar from './components/SearchBarCPN.vue'
import Header from './components/Header.vue'
import MyProfile from './components/MyProfile.vue'

import Messages from './components/Messages.vue'

import Match from './components/Match.vue'

//Font Awesome
import 'vue-awesome/icons/flag'
import 'vue-awesome/icons'
import Icon from 'vue-awesome/components/Icon.vue'
Vue.component('icon', Icon)

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
			path: '/home',
			component: Home
		},
		{
			name : 'login',
			path: '/login/',
			component: Login
		},
		{
			name : 'profil',
			path: '/profil/',
			component: Profil
		},
		{
			name : 'register',
			path: '/register/',
			component: Register
		},
		{
			name : 'match',
			path: '/match/',
			component: Match
		},
		{
			name: 'searchBar',
			path: '/searchBar',
			component: SearchBar
		},
		{
			name : 'header',
			path: '/header/',
			component: Header
		},
		{
			name: 'messages',
			path: '/messages/:conversationID',
			component: Messages
		},
		{
			name: 'myProfile',
			path: '/myProfile/',
			component: MyProfile
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
