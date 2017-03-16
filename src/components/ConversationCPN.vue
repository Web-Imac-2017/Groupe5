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
    <textarea maxlength="115" v-on:keyup.enter="sendMessage();" v-model="newMessage" :style="{background:$parent.$parent.getLightColor($parent.connectedUser.color)}"></textarea>
    <input type="file" name="messageImage" id="messageImage" v-on:change="sendImage()">
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
      this.init();
    }
  },
  created: function() {
    this.init();
    //this.updateBottomScroll();
  },
  mounted: function() {
    this.init();

    var _this = this;

    setTimeout(function() {
      _this.scrollBottomAuto();
    }, 500);

    setInterval(function() {
      _this.getConversation();
    }, 3000);
  },
  methods: {
    init: function() {
      this.me = this.$parent.connectedUser;
      this.newMessage="";
      var _this = this;
      setTimeout(function() {
        _this.getConversation();
      }, 1000);
    },
    getUser: function(user) {
      var theClass = 'user_other';

      if(user == this.me.pseudo){
        theClass = 'user_me';
      }
      return theClass;
    },
    getBackground: function(user){
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
          //console.log(data[1]);
        }
        else {
          _this.users = data['users'];
          _this.messages = data['messages'];
          _this.getImages();
          // Ne marche pas si plusieurs smileys :
          //_this.getSmiley();
        }
      });
    },
    getImages : function() {
      for(var i = 0; i < this.messages.length; i ++) {
        if(this.messages[i].content != "" && this.messages[i].content != null) {
          if(this.messages[i].content.indexOf("PLUME_IMAGE_MESSAGE") !== -1) {
            this.messages[i].content = this.messages[i].content.substr(19);
            var div = document.getElementById("Message" + this.messages[i].ID);
            if(div != null) {
              if(div.children.length == 2) {
                var image = document.createElement('img');
                image.src = 'http://localhost/PLUME/public_html' + this.messages[i].content;
                div.append(image);
              }
            }
            this.messages[i].content = "";
          }
          else {

          }
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
          //console.log(data[1]);
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
      var _this = this;
      this.$http.post(apiRoot() + 'Controllers/Image/uploadImageMessage.php', oData).then(function() {
        _this.init();
      });

    },
    replaceTxtBySmiley : function(smiley,name,messages){

        //on récupère la balise html de la bulle concerné
        var domElm = document.getElementById("Message" + messages.ID);
        domElm.innerHTML="";

        var rest = messages.content;
        do
        {
          //je récupère la position du smiley
          var pos = rest.indexOf(smiley);
          //Je selectionne le debut jusqu'a après le premier smiley
          var str = rest.slice(0,pos+2);
          //Je met le reste dans rest
          var rest = rest.slice(pos+2);

          //je créer une image
          var image = document.createElement('img');
          image.src = "http://localhost/PLUME/public_html/static/smileys/"+name+".svg";
          image.className = "smiley";

          //Je supprime le smiley text de str
          str = str.replace(smiley, "");

          //On met dans la balise html le texte puis l'image
          domElm.append(str);
          domElm.append(image);

        } while (rest != "" && rest.indexOf(":)") !== -1);
    },
    getSmiley : function() {
      for(var i = 0; i < this.messages.length; i ++) {

        var regex = new RegExp(/:\)|:D|:\(|:O|:P|:\/|<3|:@/g);

        if (this.messages[i].content.match(regex)) {
          var match = this.messages[i].content.match(regex);
          var smiley = match[0];
          switch (smiley) {
            case ":)":
              this.replaceTxtBySmiley(smiley,"smile" ,this.messages[i]);
            break;
            case ":D":
              this.replaceTxtBySmiley(smiley,"happy" ,this.messages[i]);
            break;
            case ":(":
              this.replaceTxtBySmiley(smiley,"sad" ,this.messages[i]);
            break;
            case ":O":
              this.replaceTxtBySmiley(smiley,"shock" ,this.messages[i]);
            break;
            case ":P":
              this.replaceTxtBySmiley(smiley,"tongue" ,this.messages[i]);
            break;
            case ":/":
              this.replaceTxtBySmiley(smiley,"jaded" ,this.messages[i]);
            break;
            case "<3":
              this.replaceTxtBySmiley(smiley,"inlove" ,this.messages[i]);
            break;
            case ":@":
              this.replaceTxtBySmiley(smiley,"angry" ,this.messages[i]);
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
