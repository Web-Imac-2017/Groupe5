<template>
  <div class="messages">
      <div class="container-fluid">
        <div class="row">   
          <div class="col-md-4">
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
import ProfilComponent from './Profil.vue'

  export default {
    data : function () {
      return {

      }
    },
    components: {
      ConversationsMenuComponent,
      ConversationComponent,
      ProfilComponent
    },
    methods: {
    }
  }
</script>


<style type="scss">


</style>
