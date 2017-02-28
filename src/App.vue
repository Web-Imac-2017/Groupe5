<template>
  <div id="app">
    <header-component class="tutulu"></header-component>
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
        connected: ''
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
      }
    },
    created: function(){
      this.getUserState();
    }
  }
</script>

<style lang="scss">
  .tutulu
  {
    text-align : center
  }
  @import 'assets/scss/design.scss';
</style>