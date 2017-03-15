<template>
  <div class="messages">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 convMenu">
            <conversations-menu-component></conversations-menu-component>
          </div>
          <div class="col-md-8">
            <conversation-component></conversation-component>
          </div>
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
    components: {
      ConversationsMenuComponent,
      ConversationComponent
    },
    methods: {
    },
    created: function() {
      if(this.$parent.connected != "true") {
        this.$parent.logout();
      }
      this.connectedUser = this.$parent.connectedUser;
    },
    mounted: function() {
      if(this.$parent.connected != "true") {
        this.$parent.logout();
      }
      this.connectedUser = this.$parent.connectedUser;
    }
  }
</script>


<style lang="scss">
.convMenu{
  padding-right: 0;
}

</style>
