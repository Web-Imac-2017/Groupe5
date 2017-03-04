<template>
  <div class="conversation">
    <ul>
      <li v-for="message in messages" :class=getUser(message.user)>
        <div class="messageContent">
          {{ message.content }}
        </div>
      </li>
    </ul>
    <textarea v-on:keyup.enter="sendMessage();" v-model="newMessage"></textarea>
  </div>

</template>


<script>
import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'

export default {
    data : function () {
      return {
      	messages : '',
        users : '',
        me : '',
        newMessage: ''
      }
    },
    watch: {
      '$route': function() {
        this.getConversation();
      }
    },
    created: function() {
      this.getConversation();
    },
    methods: {
      getUser: function(user) {
        var theClass = 'user_other';
        if(user == this.me.pseudo){
            theClass = 'user_me';
        }
        return theClass;
      },
      getConversation: function() {
        var _this = this;
        var _conversationID = this.$route.params.conversationID;
        fetch(apiRoot() + 'Controllers/Conversation/getAllMessages.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({conv : _conversationID})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            console.log("ERREUR !!");
          }
          else {
            _this.messages = data['messages'];
            _this.users = data['users'];
            console.log(data);
          }
        });

        this.me = { pseudo : "kingofimac" }
      },
      sendMessage() {
        var _this = this;
        var _conversationID = this.$route.params.conversationID;
        fetch(apiRoot() + 'Controllers/Conversation/addMessage.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({message: _this.newMessage, conv: _conversationID})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            console.log("ERREUR !!");
          }
          else {
            location.reload();
          }
        });
      }
    }
  }

</script>


<style lang="scss">

$profil_color: rgb(195,39,47);
$profil_color_light: rgb(225,146,150);

.conversation ul {
  padding: 0;
}

.conversation textarea {
  outline: none;
  resize: none;
  overflow: auto;
  background-color: $profil_color_light;
  width: 100%;
  border: 2px solid #000;
  border-radius: 10px;
}

.user_other, .user_me {
  list-style: none;
  width: 100%;
  display: inline-block;
}

.user_other .messageContent, .user_me .messageContent {
  padding: 10px;
  border-radius: 10px;
  display: block;
  max-width: 60%;
}

.user_other .messageContent {
  color: #000000;
  background-color: #cdcccc;
  float: left;
}

.user_me .messageContent {
  color: #ffffff;
  background-color: $profil_color;
  float: right;
}


</style>
