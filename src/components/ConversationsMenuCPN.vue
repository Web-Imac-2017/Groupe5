<template>
  <div class="conversationsMenu">
    <div class="CMHeader">
      <router-link v-bind:to="'/home/'"><icon name="long-arrow-left"></icon>back</router-link>
      <img v-bind:src="'/static/img/logo.png'" class="CMLogo">
    </div>
    <ul>
      <li v-for="conversation in conversations" class="row">
        <router-link v-bind:to="'/messages/' + conversation.id" :class=getActiveConversation(conversation.id) class="user">
          <span class="avatar" v-on:click="$parent.$parent.changeSelectedUser('maureeniz')">
            <img src="../../static/avatar/maureeniz.jpg">
          </span>
          <span v-for="user in conversation.users" class="text-conv">
            <p class="titleConversation userPseudo" :class=getUserState(user)>{{ user.pseudo }} <icon name="circle"></icon></p>
            <p class="lastMessage">{{ conversation.lastMessage }}</p>
          </span>
          <span v-on:click="deleteConv(conversation.id)" class="quit">
            <icon name="times"></icon>
          </span>
        </router-link>
      </li>
      <li class="row addPlume">
        <router-link v-bind:to="'/home/'" class="user">
          <span class="avatar">
            <div class="plus">
              <icon name="plus"></icon>
            </div>
          </span>
          <span class="text-conv">
            <p class="userPseudo">New Plume</p>
          </span>
        </router-link>
      </li>
    </ul>

  </div>

</template>


<script>
import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'

export default {
  data : function () {
    return {
      conversations : '',
      me : {}
    }
  },
  watch: {
    '$route': function() {
      this.me = this.$parent.connectedUser;
      this.getConversations();
    }
  },
  created: function() {
    this.me = this.$parent.connectedUser;
    this.getConversations();
  },
  methods: {
    getActiveConversation: function(id) {
      var theClass = '';
      if(id == this.$route.params.conversationID){
        theClass = 'active';
      }
      return theClass;
    },
    getUserState: function(user) {
      var theClass = 'userNonConnected';
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/getUserState.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: user.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
        }
        else {
          if(data[0] == 2) theClass = "userConnected";
        }
      }
    );
    return theClass;
  },
  getConversations: function() {

    var _this = this;
    console.log(this.me);
    fetch(apiRoot() + 'Controllers/Conversation/getUserConversations.php', {
      method: 'POST',
      headers: {
        'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
        'Content-Type': 'application/json; charset=utf-8'
      },
      dataType: 'JSON',
      body: JSON.stringify({pseudo: _this.me.pseudo})
    }).then(function(response) {
      return response.json();
    }).then(function(data){
      if(data[0] == "Error"){
        console.log("ERREUR !!");
      }
      else {
        _this.conversations = data['conversations'];
      }
    });
  },
  deleteConv: function(id){
    var _conversationID = id;
    fetch(apiRoot() + 'Controllers/Conversation/deleteConversation.php', {
      method: 'POST',
      headers: {
        'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
        'Content-Type': 'application/json; charset=utf-8'
      },
      dataType: 'JSON',
      body: JSON.stringify({id : id})
    }).then(function(response) {
      return response.json();
    }).then(function(data){
      if(data[0] == "Error"){
        console.log("ERREUR !!");
      }
    });
  }
}
}
</script>


<style lang="scss">

$profil_color: rgb(195,39,47);
$profil_color_light: rgb(225,146,150);
$avatar_size: 80px;


.conversationsMenu{
  overflow-x: hidden;
  overflow-y: auto;
  border-right: 1px solid #000;
  height: 100vh;

  [class*="col"]{
    padding: 0;
  }
  .row{
    margin: 10px 0;
  }
  span{
    display: inline-block;
    margin: auto 0;
  }
  p{
    margin: 0;
    vertical-align: middle;
  }

  .CMHeader{
    text-align: center;
    padding: 50px;
    a{
      text-transform: uppercase;
      font-size: 20px;
      margin-bottom: 20px;
      display: block;
    }
    .CMLogo{
      width: 150px;
    }
    .fa-icon{
      margin-right: 10px;
    }
  }

  .user{
    height: $avatar_size;
    display: flex;

    .avatar {
      vertical-align: middle;
      img{
        height: $avatar_size;
        width: $avatar_size;
        border: 1px solid #000;
      }
    }

    .text-conv{
      margin-left: 15px;
      width: 100%;
      .userPseudo {
        text-transform: uppercase;
        font-weight: 600;
        font-size: 20px;
        &.userConnected svg {
          color: #38B647;
        }
        &.userNonConnected svg {
          color: #C02029;
        }
      }
      .lastMessage {
        display: block;
        font-style: italic;
        font-size: 12px;
      }
    }
    .quit{
      position: relative;
      right: 10px;
      top: -15px;
    }
  }
  .user.router-link-active.active {
    background-color: $profil_color_light;
  }
  .addPlume{
    margin-bottom: 50px;
    .plus{
      width: $avatar_size;
      height: $avatar_size;
      border: 1px solid #000;
      background-color: $profil_color_light;
      text-align: center;
      display: flex;
      .fa-icon{
        margin: auto;
      }
    }
  }

  /*ScrollBar*/

}
</style>
