<template>
	<div class="header">
		  <router-link v-bind:to="'/home/'">Home</router-link>
      <router-link v-if="connected === 'true'" v-bind:to="'/home/'">Messages</router-link>
      <router-link v-if="connected === 'true'" v-bind:to="'/home/'">Matchs</router-link>
      <router-link v-if="connected === 'true'" v-bind:to="'/profil/'">Profil</router-link>
      <router-link v-if="connected === ''" v-bind:to="'/login/'">Sign up / Sign in</router-link>
      <a v-if="connected === 'true'" v-on:click.prevent="logout">Sign out</a>
	</div>
</template>

<script>
	export default {
    data(){
      return {
      	connected: ''
      }
  	},
  	methods: {
    	logout(){
    		console.log("Deconnect");
    		document.cookie = "idUser=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
      	document.cookie = "pseudo=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
    		this.connected = '';
    		location.reload();
    	}
    },
    created: function(){
    	function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
      }
      if(getCookie('idUser')) this.connected = "true";
      else this.connected = '';
    }
  }
</script>

<style type="scss">

</style>
