<template>
  <div id="app">
    <header-component></header-component>
    <router-view keep-alive></router-view>
    <footer-component></footer-component>
  </div>
</template>

<script>
import {apiRoot} from '../config/localhost/settings.js'
import HeaderComponent from './components/Header.vue'
import FooterComponent from './components/Footer.vue'

export default {
  components: {
    HeaderComponent,
    FooterComponent
  },
  data(){
    return {
      connected: '',
      selectedUser: ''
    }
  },
  methods: {
    logout: function(){
      this.connected = '';
      this.$route.router.go('/home/');
    },
    getUserState: function() {
      this.$http.post(
        apiRoot() + 'Controllers/User/getUserState.php',
        {headers : {'Content-Type' : 'application/json; charset=UTF-8', 'Accept': 'application/json, application/xml, text/plain, text/html, *.*'}}
      ).then(
        function(response) {
          if(response.data[0] == "Error"){
            this.loginError = response.data[1];
          }
          else {
            if(response.data[0] == 0) this.connected = "";
            else this.connected = "true";
          }
        }
      );
    },
    getUser: function(){
      var _this = this;
      var _selectedUser = this.selectedUser/*recuperer quand on click sur le peudo, le pseudo*/;

      fetch(apiRoot() + 'Controllers/User/getUser.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify(pseudoUserToGet: _selectedUser)
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        _this.user.pseudo = data['pseudo'];
        _this.user.firstname = data['firstname'];
        _this.user.lastname = data['lastname'];
        _this.user.age = data['age'];
        _this.user.country = data['country'];
        _this.user.city = data['city'];
        _this.user.description = data['description'];
        _this.user.color = data['color'];
        _this.user.hobbies = data['hobbies']; //Return tab with hobbies
        _this.user.languages.spokenLang = languagesToFlag(data['spokenLang']); //Return tab with mastered languages
        _this.user.languages.learningLang = languagesToFlag(data['learningLang']); //Return tab with learning languages
      });
    },
    created: function(){
      this.getUserState();
      this.getUser();
    }
  }
}
function languagesToFlag(country) {
  var flag = {
    portuguese : '/static/flags/portugal.png',
    english : '/static/flags/united-kingdom.png',
    chinese : '/static/flags/china.png',
    french : '/static/flags/france.png',
    japanese : '/static/flags/japan.png',
    german : '/static/flags/germany.png',
    spanish : '/static/flags/spain.png'
  }
  return flag[country];
}
</script>

<style lang="scss">
@import 'assets/scss/design.scss';
@import 'assets/scss/reset.css'
</style>
