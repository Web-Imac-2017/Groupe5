<template>
  <div class="connexion">
    <div class="error-message" v-text="loginError"></div>
    <input type="text" name="user" placeholder="Email or Username" v-model="loginUser">  
    <input type="password" name="password" placeholder="Password" v-model="loginPassword">  
    <input type="submit" v-on:click="login" v-model="loginSubmit"  id="loginSubmit">  
    <!--<input type="submit" v-on:click="login" v-model="loginSubmit"  id="loginSubmit">-->
  </div>

</template>


<script>
//import router from './../router'

	export default {
    data : function () {
      return {
        loginError: '',
        loginUser: '',
        loginPassword: '',
        loginSubmit: ''
      }
    },
    methods: {
      login() {
        // Connection test without back files
        if(this.loginUser == "coucoucnous" && this.loginPassword == "mdp") {
          console.log("Connexion !");
          //location.reload();
          //router.go({ name: 'HomeConnected'});
        }
        else {
          this.loginError = "User unknowm or password uncorrect.";
        }
      }
    }
	}
</script>


<style type="scss">

</style>
