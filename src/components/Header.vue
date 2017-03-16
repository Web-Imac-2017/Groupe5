<template>
<<<<<<< HEAD
  <div class="header">

    <router-link v-bind:to="'/home/'"><img v-bind:src="'/static/img/logo.png'" class="headerlogo"></router-link>
    <a class="item" v-on:click.prevent="$parent.logout">SIGN OUT</a>
    <router-link class="item" v-bind:to="'/myProfile/'">MY PROFILE</router-link>
    <router-link class="item" v-bind:to="'/messages/'">MESSAGES</router-link>
    <router-link class="item" v-if="$parent.connected === ''" v-bind:to="'/match/'">MATCHING</router-link>
    <search-bar-component class="search"></search-bar-component>

  </div>
=======
    <div class="header">
        <router-link v-bind:to="'/home/'"><img src="http://www.plume.ink/public_html/static/img/logo.png" class="headerlogo"></router-link>
        <a class="item" v-on:click.prevent="$parent.logout">SIGN OUT</a>
        <router-link class="item" v-bind:to="'/messages/'">MESSAGES</router-link>
        <router-link class="item" v-bind:to="'/myProfile/'">MY PROFILE</router-link>
        <router-link class="item" v-bind:to="'/match/'">MATCHING</router-link>
        <search-bar-component class="search"></search-bar-component>
    </div>
>>>>>>> 1dada203a0ffe5e55064a9bb21d7ccf4cf1fe3a0
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

<<<<<<< HEAD
  .search
  {
    position: relative;
  }

  a{
    cursor: pointer;
    z-index: 15;
  }
}
=======
        .item:hover
        {
            border-bottom: 3px solid rgba(0, 0, 0, 1);
        }
        .search
        {
            position: relative;
            z-index: 15;
        }
    }
>>>>>>> 1dada203a0ffe5e55064a9bb21d7ccf4cf1fe3a0

</style>
