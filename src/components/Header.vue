<template>
    <div class="header">
        <img v-bind:src="'/static/img/logo.png'" class="headerlogo">
        <router-link class="item" v-bind:to="'/home/'">Home</router-link>
        <router-link class="item" v-if="$parent.connected === 'true'" v-bind:to="'/home/'">Messages</router-link>
        <router-link class="item" v-if="$parent.connected === 'true'" v-bind:to="'/home/'">Matchs</router-link>
        <router-link class="item" v-if="$parent.connected === 'true'" v-bind:to="'/profil/'">Profil</router-link>
        <router-link class="item" v-if="$parent.connected === ''" v-bind:to="'/login/'">Sign up / Sign in</router-link>
        <a class="item" v-if="$parent.connected === 'true'" v-on:click.prevent="$parent.logout">Sign out</a>
        <router-link class="item" v-if="$parent.connected === ''" v-bind:to="'/register/'">Register</router-link>
    </div>
</template>

<script>
  export default {
  }
</script>

<style lang="scss">

    .header
    {
        height: 100px;
        width: 100%;
        position: fixed;
        box-shadow: 0px 3px 15px rgba(0, 0, 0, .4);

        .headerlogo
        {
            height: 60%;
            position: relative;
            top: 50%;
            left: 30px;
            transform: translateY(-50%);
        }

        .item
        {
            margin: 0;
            float: right;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            right: 50px;
            font-size: 2em;
            margin-left: 25px;
            font-family: Montserrat;
            color: black;
            text-decoration: none;
            transition: .2s;
            border-bottom: 3px solid rgba(0, 0, 0, 0);
            padding: 5px;
        }

        .item:hover
        {
            border-bottom: 3px solid rgba(0, 0, 0, 1);
        }
    }

</style>
