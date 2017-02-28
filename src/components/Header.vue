<template>
    <div class="header">
        <img v-bind:src="'/static/img/logo.png'" class="headerlogo">
        <router-link v-bind:to="'/home/'">Home</router-link>
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
    .header
    {
        background-color: pink;
        height: 80px;
        width: 100%;
        position: fixed;

        .headerlogo
        {
            margin-left: 150px;
        }
    }
</style>
