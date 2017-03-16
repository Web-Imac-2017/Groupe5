<template>
    <div class="header">
        <router-link v-bind:to="'/home/'"><img v-bind:src="'http://localhost/PLUME/public_html/static/img/logo.png'" class="headerlogo"></router-link>
        <a class="item" v-on:click.prevent="$parent.logout">SIGN OUT</a>
        <router-link class="item" v-bind:to="'/messages/'">MESSAGES</router-link>
        <router-link class="item" v-bind:to="'/myProfile/'">MY PROFILE</router-link>
        <router-link class="item" v-bind:to="'/match/'">MATCHING</router-link>
        <search-bar-component class="search"></search-bar-component>
    </div>
</template>

<script>
import SearchBarComponent from './SearchBarCPN.vue';

  export default {
    components : {
        SearchBarComponent
    }
  }
</script>

<style lang="scss">

    .header
    {
        height: 50px;
        width: 100%;
        // position: fixed;
        // z-index: 1;
        // top: 0;
        background: #fff;
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
            font-size: 1.2em;
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
        .search
        {
            position: relative;
            z-index: 1000;
        }
    }

</style>
