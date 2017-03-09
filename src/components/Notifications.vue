<template>
  <div class="messages">
      <div class="container-fluid">
        <div class="row">
          <ul>
            <li v-for="notif in notifications"> {{ notif.content }} </li>
          </ul>
        </div>
      </div>

  </div>

</template>


<script>
import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'
import ConversationsMenuComponent from './ConversationsMenuCPN.vue'
import ConversationComponent from './ConversationCPN.vue'

  export default {
    data : function () {
      return {
        connectedUser: {},
        notifications : []
      }
    },
    methods: {
      getNotifications : function(pseudo) {
        var _this = this;
        fetch(apiRoot() + 'Controllers/Notification/getAllNotif.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({pseudo : pseudo})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            console.log(data[1]);
          }
          else {
            //console.log(data);
            _this.notifications = data["notifications"];
          }
        });
      },
      deleteNotification : function(id) {
        var _this = this;
        fetch(apiRoot() + 'Controllers/Notification/deleteNotif.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({ID : id})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            console.log(data[1]);
          }
          else {
            //console.log(data);
            _this.notifications = data["notifications"];
          }
        });
      },
      addNotification : function(pseudo1, pseudo2, content) {
        var _this = this;
        fetch(apiRoot() + 'Controllers/Notification/addNotification.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({pseudo1 : pseudo1, pseudo2 : pseudo2, contenu : content})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            console.log(data[1]);
          }
          else {
            //console.log(data);
            _this.notifications = data["notifications"];
          }
        });
      }
    },
    created: function() {
      var _this = this;
      this.connectedUser = this.$parent.connectedUser;
      setTimeout(function() {
        _this.getNotifications(_this.connectedUser.pseudo);
      }, 500);
    },
    mounted: function() {
      var _this = this;
      this.connectedUser = this.$parent.connectedUser;
      setTimeout(function() {
        _this.getNotifications(_this.connectedUser.pseudo);
      }, 500);
    }
  }
</script>


<style lang="scss">
.convMenu{
  padding-right: 0;
}

</style>
