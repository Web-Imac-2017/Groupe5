<template>
  <div class="conversation">
    <ul id="messages">
      <li v-for="message in messages" :class=getUser(message.user)>
        <div class="messageContent" :style="{background:getBackground(message.user)}" v-bind:id="'Message' + message.ID">
          <span>{{ "["+message.date+"]" }}</span>
          <p>{{ message.content }}</p>
        </div>
      </li>
    </ul>
    <textarea v-on:keyup.enter="sendMessage();" v-model="newMessage" :style="{background:$parent.$parent.getLightColor($parent.connectedUser.color)}"></textarea>
    <input type="file" name="messageImage" id="messageImage" v-on:click="sendImage()">
    <label for="messageImage"><icon name="picture-o"></icon></label>
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
      me : {},
      newMessage: ''
    }
  },
  watch: {
    '$route': function() {
      this.me = this.$parent.connectedUser;
      this.init();
    }
  },
  created: function() {
    this.me = this.$parent.connectedUser;
    this.init();
  },
  updated: function(){
    this.scrollBottomAuto();
  },
  methods: {
    init: function() {
      this.newMessage="";
      this.getConversation();
      var _this = this;
      setTimeout(function() {
        _this.getImages();
        _this.getSmiley();
      }, 1000);
    },
    getUser: function(user) {
      var theClass = 'user_other';

      if(user == this.me.pseudo){
        theClass = 'user_me';
      }
      return theClass;
    },
    getBackground(user){
      if(user == this.me.pseudo){
        return this.$parent.connectedUser.color;
      }
      else{
        return '#cdcccc';
      }
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
        body: JSON.stringify({id : _conversationID, pseudo: _this.me.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.messages = data['messages'];
          _this.users = data['users'];
        }
      });
    },
    getImages : function() {
      for(var i = 0; i < this.messages.length; i ++) {
        if(this.messages[i].content.indexOf("PLUME_IMAGE_MESSAGE:") !== -1) {

          this.messages[i].content = this.messages[i].content.substr(20,this.messages[i].content.length-1);

          var div = document.getElementById("Message" + this.messages[i].ID);
          if(div.children.length == 2) {
            var image = document.createElement('img');
            image.src = this.messages[i].content;

            div.append(image);
          }

          this.messages[i].content = "";
        }
      }
    },
    sendMessage: function() {
      var _this = this;
      var _conversationID = this.$route.params.conversationID;
      fetch(apiRoot() + 'Controllers/Conversation/addMessage.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({message: _this.newMessage, conv: _conversationID, pseudo: _this.me.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.init();
        }
      });
    },
    sendImage : function() {
      var form = document.querySelector('#messageImage');
      var file = form.files[0];
      var oData = new FormData();
      var im = oData.append("avatar", file);
      var pseudo = oData.append("pseudo", this.me.pseudo);
      var idConv = oData.append("id_conv", this.$route.params.conversationID);
      this.$http.post(apiRoot() + 'Controllers/Image/uploadImageMessage.php', oData);
      this.init();

    },
    replaceTxtBySmiley : function(message, match, name, domElm){
      var pos = match.index;
      var image = document.createElement('img');
      image.src = "/static/smileys/"+name+".svg";
      image.className = "smiley";
      message.content = message.content.replace(match[0], " ");
      var part1 = message.content.slice(0, pos);
      var part2 = message.content.slice(pos);
      domElm.append(image);
      message.content = "";
      domElm.append(part1);
      domElm.append(image);
      domElm.append(part2);
    },
    getSmiley : function() {
      for(var i = 0; i < this.messages.length; i ++) {
        //var re = /:\)|=\)|:-\)|:D|=D|:-D|:\(|=\(|:-\(|:O|=O|:-O|:P|=P|:-P|:\/|=\/|:-\/|<3|:@|=@|:-@|>:-\(/g,
        var regex = /:\)|:D|:\(|:O|:P|:\/|<3|:@/g,
          str = this.messages[i].content;
          var match;
          var domElm = document.getElementById("Message" + this.messages[i].ID);

          while ((match = regex.exec(str)) != null) {
            domElm.innerHTML="";

            switch (match[0]) {
              case ":)":
              this.replaceTxtBySmiley(this.messages[i], match, "smile", domElm);
              break;
              case ":D":
              this.replaceTxtBySmiley(this.messages[i], match, "happy", domElm);
              break;
              case ":(":
              this.replaceTxtBySmiley(this.messages[i], match, "sad", domElm);
              break;
              case ":O":
              this.replaceTxtBySmiley(this.messages[i], match, "shock", domElm);
              break;
              case ":P":
              this.replaceTxtBySmiley(this.messages[i], match, "tongue", domElm);
              break;
              case ":/":
              this.replaceTxtBySmiley(this.messages[i], match, "jaded", domElm);
              break;
              case "<3":
              this.replaceTxtBySmiley(this.messages[i], match, "inlove", domElm);
              break;
              case ":@":
              this.replaceTxtBySmiley(this.messages[i], match, "angry", domElm);
              break;
            }
          }
        }
      },
      scrollBottomAuto: function(){
        var container = this.$el.querySelector("#messages");
        container.scrollTop = container.scrollHeight;
      }
    }
  }
  </script>


  <style lang="scss">

  .conversation{

    ul {
      padding: 0;
      overflow-x: hidden;
      overflow-y: auto;
      height: calc(100vh - 140px);
    }
    textarea {
      outline: none;
      resize: none;
      border: 2px solid #000;
      border-radius: 10px;
      width: 100%;
      position: relative;
      bottom: 0;
      right: 0;
      left: 0;
      padding: 10px;
      height: 60px;
      color: #000;
      padding-left: 65px;
    }
    input{
      display: none;
    }
    label{
      cursor: pointer;
      position: absolute;
      bottom: 6px;
      left: 35px;
      .fa-icon{
        width: 30px;
        height: 30px;
      }
    }


    .user_other, .user_me {
      list-style: none;
      width: 100%;
      display: inline-block;
      margin: 5px 0;
    }

    .user_other, .user_me{
      .messageContent{
        padding: 10px;
        border-radius: 10px;
        display: block;
        max-width: 60%;
      }
      span{
        font-size: 10px;
        display: block;
        margin-bottom: 10px;
      }
    }

    .user_other {
      .messageContent {
        color: #000000;
        background-color: #cdcccc;
        float: left;
      }
    }

    .user_me {
      .messageContent {
        color: #ffffff;
        float: right;
      }
      .messageDate{

      }
    }
    .smiley{
      width: 40px;
    }
  }
  </style>
