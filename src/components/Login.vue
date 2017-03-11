<template>
  <div class="connexion" v-bind:style="{backgroundImage: 'url(../../static/img/bg.jpg)'}">
    <div class="wrapper">
      <!-- <h1>Connexion</h1> -->
      <img v-bind:src="'/static/img/logo.png'" class="loginlogo">
      <div class="error-message" v-text="loginError"></div>
      <input type="text"  name="pseudo" id="pseudo" placeholder="ID" v-model="pseudo">  
      <input type="password" name="password" id="password" placeholder="PASSWORD" v-model="password">  
      <input type="submit" v-on:click="login" v-model="submit" id="submit">
    </div>
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
            _this.$parent.setCookie("PLUME_pseudo", _this.pseudo, 10)
            _this.$parent.setUserState(_this.pseudo, "true");
            _this.$parent.setConnectedUser(_this.$parent.getCookie("PLUME_pseudo"));
            _this.$router.push('/messages/');
          }
        });
      }
    }
  }
</script>


<style lang="scss">

    @keyframes colorize
    {
        0% {background-color: #FAD6A6;}
        25% {background-color: #FF717E;}
        50% {background-color: #F9B69C;}
        75% {background-color: #6ABE83;}
        100% {background-color: #FAD6A6;}
    }

    .connexion
    {
        width: 100vw;
        height: 100vh;
        background-size: cover;
        background-position: center center;
        font-family: Montserrat;
        font-weight: 700;
        text-align: center;

        .wrapper
        {
            width: 400px;
            height: auto;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
        }

        .loginlogo
        {
            position: relative;
            width: 200px;
            margin-bottom: 30px;
        }

        input
        {
            display: block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: 5px;
            border: 2px solid black;
            padding: 10px 15px;
            text-transform: uppercase;
            font-size: 1.5em;
            background: transparent;
            width: 100%;
        }

        #submit
        {
            width: 100%;
            margin-bottom: 0;
            background: transparent;
            transition: 1s;
        }

        #submit:hover
        {
            animation: colorize 2s infinite;
        }
    }

</style>
