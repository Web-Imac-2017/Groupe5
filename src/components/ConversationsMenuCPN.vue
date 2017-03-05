<template>
  <div class="conversationsMenu">
    <div class="CMHeader">
      <router-link v-bind:to="'/home/'"><icon name="long-arrow-left"></icon>back</router-link>
      <img v-bind:src="'/static/img/logo.png'" class="CMLogo">
    </div>
    <ul>
      <li v-for="conversation in conversations" class="row">
        <router-link v-bind:to="'/messages/' + conversation.id" :class=getActiveConversation(conversation.id) class="user">
          <span class="avatar">
            <img src="../../static/avatar/maureeniz.jpg">
          </span>
          <span v-for="user in conversation.users" class="text-conv">
            <p class="titleConversation userPseudo">{{ user.pseudo }}</p>
            <p class="lastMessage">{{ conversation.lastMessage }}</p>
          </span>
          <span v-on:click="deleteConv(conversation.id)" class="quit">
            <icon name="times"></icon>
          </span>
        </router-link>
      </li>
      <li class="row addPlume">
        <router-link v-bind:to="'/messages/' + 0" class="user">
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
      conversations : ''
    }
  },
  watch: {
    '$route': function() {
      this.getMessages();
    }
  },
  methods: {
    getActiveConversation: function(id) {
      var theClass = '';
      if(id == this.$route.params.conversationID){
        theClass = 'active';
      }
      return theClass;
    },
    getMessages: function() {
      var _this = this;
      fetch(apiRoot() + 'Controllers/Conversation/getUserConversations.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON'
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
      fetch(apiRoot() + 'Controllers/Conversation/getAllMessages.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({conversation : _conversationID})
      });
    }
  },
  created: function() {
    this.getMessages();
  }
}
</script>


<style lang="scss">

$profil_color: rgb(195,39,47);
$profil_color_light: rgb(225,146,150);
$avatar_size: 80px;


.conversationsMenu {
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
  overflow-x: hidden;
  overflow-y: auto;
  border-right: 1px solid #000;
  height: 100%;

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

}
</style>
