<template>
  <div class="conversationsMenu">
    <h1>Your Plumes</h1>
    <ul>
      <li v-for="conversation in conversations">
        <router-link v-bind:to="'/messages/' + conversation.id" :class=getActiveConversation(conversation.id) class="user">
          <p>
            <img src="../../static/avatar/maureeniz.jpg" class="avatar">
            <span v-for="user in conversation.users">
              <span class="titleConversation userPseudo">{{ user.pseudo }}</span>
              <span class="lastMessage">{{ conversation.lastMessage }}</span>
            </span>
          </p>
          
        </router-link>
      </li>
      <li>
        <div>
          <div class="titleConversation">New Plume</div>
        </div>
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
      }
    },
    created: function() {
      this.getMessages();
    }
  }
</script>


<style type="scss">

img.avatar {
  height: 60px;
  width: 60px;
  vertical-align: middle;
}

.conversationsMenu {
  overflow-y: auto;
}

.user, .user:hover, .user:link, .user:visited {
  text-decoration: none;
  color: #000;
}

.user.router-link-active.active p{
  background-color: #fce7d2;  
}

.lastMessage {
  display: block;
}

h1 {
  font-size: 15px;
  text-align: center;
}

.titleConversation {
  font-weight: bold;
  font-size: 25px;
  display: inline-block;
}

.userPseudo {
  text-transform: uppercase;
}


</style>
