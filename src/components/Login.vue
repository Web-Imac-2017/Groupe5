<template>
  <div class="connexion">
      <h1>Connexion</h1>
      <p>Pseudo:</p><br>
      <div class="error-message" v-text="loginError"></div>
      <input type="text"  name="pseudo" id="pseudo" placeholder="Email or Username" v-model="pseudo">  
      <p>Mot de passe:</p><br>
      <input type="password" name="password" id="password" placeholder="Password" v-model="password">  
      <input type="submit" v-on:click="login" v-model="submit" id="submit">
  </div>

</template>


<script>
import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'

  export default {
    data : function () {
      return {
        loginError: '',
        pseudo: '',
        password: '',
        submit: ''
      }
    },
    methods: {
      login: function() {
        var _this = this;
        fetch(apiRoot() + 'Controllers/User/login.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({pseudo : this.pseudo, password : this.password})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            _this.loginError = data[1];
          }
          else {
            _this.$router.push('/home/');
            _this.$parent.getUserState();
          }
        });
      }
    }
  }
</script>


<style type="scss">

</style>
