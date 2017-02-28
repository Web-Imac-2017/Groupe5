<template>
  <div id="app">
    <!-- <header-component></header-component> -->
    <router-view keep-alive></router-view>
    <profil-component v-if="profilShowed === 'true'"></profil-component>
    <footer-component></footer-component>
  </div>
</template>

<script>
import {apiRoot} from '../config/localhost/settings.js'
import HeaderComponent from './components/Header.vue'
import FooterComponent from './components/Footer.vue'
import ProfilComponent from './components/ProfilCPN.vue'

export default {
  components: {
    HeaderComponent,
    FooterComponent,
    ProfilComponent
  },
  data(){
    return {
      connected: '',
      selectedUser: {
        id : '',
        pseudo: '',
        avatar: '',
        firstname: '',
        lastname: '',
        age: '',
        country: '',
        description: '',
        city: '',
        hobbies: '',
        languages: {
          spokenLang: '',
          learningLang: ''
        }
      },
      profilShowed: ''
    }
  },
  methods: {
    logout: function(){
      this.connected = '';
      this.$route.router.go('/home/');
    },
    getUserState: function() {
      var _this = this;

      fetch(apiRoot() + 'Controllers/User/getUserState.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON'
      }).then(function(response) {
        return response.json();
      }).then(function(data){
          if(data[0] == "Error"){
            _this.loginError = data[1];
          }
          else {
            if(data[0] == 0) _this.connected = "";
            else _this.connected = "true";
          }
        }
      );
    },
    getSelectedUser: function(){
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/getUser.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudoUserToGet: _this.selectedUser.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        _this.selectedUser.pseudo = data['pseudo'];
        _this.selectedUser.avatar = data['avatar'];
        _this.selectedUser.firstname = data['firstname'];
        _this.selectedUser.lastname = data['lastname'];
        _this.selectedUser.age = data['age'];
        _this.selectedUser.country = data['country'];
        _this.selectedUser.city = data['city'];
        _this.selectedUser.description = data['description'];
        _this.selectedUser.color = data['color'];
        _this.selectedUser.hobbies = data['hobbies'];
        _this.selectedUser.languages = data['languages'];
      });
    },
    languagesToFlag: function(country) {
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
    },
    changeSelectedUser: function(pseudo) {
      if(pseudo != '') {
        this.selectedUser.pseudo = pseudo;
        this.getSelectedUser();
        this.profilShowed = "true";
      }
      else {
        this.selectedUser.pseudo = '';
        this.profilShowed = "false";
      }
    }
  },
  created: function(){
    this.profilShowed = "false";
    this.getUserState();
  }
}
</script>

<style lang="scss">
@import 'assets/scss/design.scss';
@import 'assets/scss/reset.css';

</style>
