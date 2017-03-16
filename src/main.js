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
import Admin from './components/Admin.vue'
import Messages from './components/Messages.vue'
import Match from './components/MatchCPN.vue'
<<<<<<< HEAD
import LegalNotice from './components/LegalNotice.vue'
=======
>>>>>>> 1dada203a0ffe5e55064a9bb21d7ccf4cf1fe3a0

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
			name: 'messagesConversation',
			path: '/messages/:conversationID',
			component: Messages
		},
		{
			name: 'messages',
			path: '/messages/',
			component: Messages
		},
		{
			name: 'myProfile',
			path: '/myProfile/',
			component: MyProfile
		},
		{
			name: 'admin',
			path: '/admin/',
			component: Admin
		},
		{
			name:'legalNotice',
			path: '/legalNotice/',
			component: LegalNotice
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
