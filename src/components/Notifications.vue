<template>
  <div class="messages">
      <div class="container-fluid">
        <div class="row">
          <ul>
            <li v-for="notif in $parent.notifications">
              <p>{{ notif.user }} {{ notif.content }}</p>
              <p v-on:click="$parent.acceptConversation(notif.user, notif.ID)">Accept</p>
              <p v-on:click="$parent.refuseConversation(notif.ID)">Refuse</p>
            </li>
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
        connectedUser: {}
      }
    },
    methods: {
    },
    created: function() {
      if(this.$parent.connected != "true") {
        this.$parent.logout();
      }
      var _this = this;
      this.connectedUser = this.$parent.connectedUser;
      setTimeout(function() {
        _this.$parent.getNotifications(_this.connectedUser.pseudo);
      }, 500);
    },
    mounted: function() {
      var _this = this;
      this.connectedUser = this.$parent.connectedUser;
      setTimeout(function() {
        _this.$parent.getNotifications(_this.connectedUser.pseudo);
      }, 500);
    }
  }
</script>


<style lang="scss">
.convMenu{
  padding-right: 0;
}

</style>
