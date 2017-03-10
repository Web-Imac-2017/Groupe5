<template>
  <div class="conversationsMenu">
    <div class="CMHeader">
      <router-link v-bind:to="'/home/'"><icon name="long-arrow-left"></icon>back</router-link>
      <img v-bind:src="'/static/img/logo.png'" class="CMLogo">
    </div>
    <ul>
      <li v-for="conversation in conversations" class="row">
        <router-link v-bind:to="'/messages/' + conversation.id" :class=getActiveConversation(conversation.id) class="user">
          <span  v-for="user in conversation.users" class="avatar" v-on:click="$parent.$parent.changeSelectedUser(user.pseudo)">
            <img :src="user.avatar">
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
        <router-link v-bind:to="'/match/'" class="user">
          <span class="avatar">
            <div class="plus" :style="{background:$parent.$parent.getLightColor($parent.connectedUser.color)}">
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
      conversations : [],
      me : {},
      otherUser: {}
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
  mounted: function() {
    this.me = this.$parent.connectedUser;
    this.getConversations();
  },
  methods: {
    getActiveConversation: function(id) {
      var colorLight = '#fff';
      if(id == this.$route.params.conversationID){
        colorLight = this.$parent.$parent.getLightColor(this.$parent.connectedUser.color);
      }
      return colorLight;
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
      // TO DO : Améliorer ça -- permet de corriger bug afficher conversations    
      setTimeout(function() {
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
            console.log(data[1]);
          }
          else {
            _this.conversations = data['conversations'];

            for(var i = 0; i < _this.conversations.length; i ++) {
              if(_this.conversations[i].lastMessage) {
                if(_this.conversations[i].lastMessage.indexOf("PLUME_IMAGE_MESSAGE:") !== -1) {

                  _this.conversations[i].lastMessage = _this.conversations[i].lastMessage.substr(20,_this.conversations[i].lastMessage.length-1);
                  
                  _this.conversations[i].lastMessage = "Image";     
                }
              }
              
            }
          }
        });

      }, 2000);
    },
    deleteConv: function(id){
      fetch(apiRoot() + 'Controllers/Conversation/deleteConversation.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({conv : id})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
        }
      });
    }
  }
}
</script>


<style lang="scss">

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
  }

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
  .addPlume{
    margin-bottom: 50px;
    .plus{
      width: $avatar_size;
      height: $avatar_size;
      border: 1px solid #000;
      text-align: center;
      display: flex;
      .fa-icon{
        margin: auto;
      }
    }
  }
<<<<<<< HEAD
=======

}
>>>>>>> refs/remotes/origin/front
</style>
