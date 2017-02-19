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
      setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
      },
      login() {
        // Connection test without back files
        if(this.loginUser == "coucoucnous" && this.loginPassword == "mdp") {
          this.setCookie("idUser", 0, 10);
          this.setCookie("pseudo","coucoucnous", 10);
          console.log("Connexion !");
          location.reload();
          this.$router.push('/home/');
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
