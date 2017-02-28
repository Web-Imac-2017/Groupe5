<template>
  <div class="header">
      <router-link v-bind:to="'/home/'">Home</router-link><br/>
      <router-link v-if="$parent.connected === 'true'" v-bind:to="'/home/'">Messages</router-link>
      <router-link v-if="$parent.connected === 'true'" v-bind:to="'/home/'">Matchs</router-link>
      <router-link v-if="$parent.connected === 'true'" v-bind:to="'/profil/'">Profil</router-link>
      <router-link v-if="$parent.connected === ''" v-bind:to="'/login/'">Sign up / Sign in</router-link>
      <a v-if="$parent.connected === 'true'" v-on:click.prevent="$parent.logout">Sign out</a>
       <router-link v-if="$parent.connected === ''" v-bind:to="'/register/'">Register</router-link>

     
  </div>
</template>

<script>
  export default {
  }
</script>

<style type="scss">

</style>
