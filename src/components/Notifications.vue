<template>
    <div class="notification" v-if="$parent.notifications != ''">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li v-for="notif in $parent.notifications">
                        <img src="/static/avatar/aleqsandr.jpg" id="avatarnotif"/>
                        <div id="textnotif">
                            <p id="textuser">{{ notif.user }}</p>
                            <p id="textcontent">{{ notif.content }}</p>
                            <div id="buttons">
                                <div id="accept">
                                    <img src="/static/img/accept.png" class="iconbutton"/>
                                    <p v-on:click="$parent.acceptConversation(notif.user, notif.ID)">Accept </p>
                                </div>
                                <div id="refuse">
                                    <img src="/static/img/refuse.png" class="iconbutton"/>
                                    <p v-on:click="$parent.refuseConversation(notif.ID)">Refuse </p>
                                </div>
                            </div>
                        </div>
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
      }, 1000);
    },
    mounted: function() {
        this.connectedUser = this.$parent.connectedUser;
        var _this = this;
        setTimeout(function() {
            _this.$parent.getNotifications(_this.connectedUser.pseudo);
        }, 1000);
    }
  }
</script>


<style lang="scss">

@keyframes fly
{
    0%
    {
        transform: scale(1.0);
        box-shadow: 0px 0px 25px rgba(0, 0, 0, .8);
    }
    50%
    {
        transform: scale(1.002);
        box-shadow: 0px 0px 50px rgba(0, 0, 0, .8);
    }
    100%
    {
        transform: scale(1.0);
        box-shadow: 0px 0px 25px rgba(0, 0, 0, .8);
    }
}

.notification
{
    position: fixed;
    z-index: 10;
    background-color: white;
    right: 20px;
    bottom: 20px;
    width: 450px;
    height: 120px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, .8);
    animation: fly 3s infinite;

    #avatarnotif
    {
        position: relative;
        display: inline-block;
        height: 120px;
        background-color: red;
    }

    #textnotif
    {
        position: relative;
        display: inline-block;
        height: 120px;
        width: 330px;
        vertical-align: middle;
        float: right;

        #textuser
        {
            margin-top: 10px;
            margin-bottom: 0;
            font-size: 1.8em;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
        }

        #textcontent
        {
            margin: 0;
            text-align: center;
        }
    }

    #buttons
    {
        position: relative;
        display: inline-block;
        height: 30px;
        width: 100%;
        text-align: center;
        margin-top: 8px;

        #accept
        {
            margin-right: 5px;
        }

        #accept, #refuse
        {
            height: 30px;
            display: inline-block;
            background-color: #222222;
            cursor: pointer;
            transition: .1s;

            &:hover .iconbutton
            {
                transform: scale(1.2);
            }

            p
            {
                display: inline-block;
                color: white;
                margin: 0;
                margin-left: 5px;
                margin-right: 10px;
            }

            .iconbutton
            {
                height: 30px;
                display: inline-block;
                transition: .1s;
            }
        }
    }
}

</style>
