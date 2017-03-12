<template>
  <div id="app">
    <notifications v-if="connected === 'true'"></notifications>
    <header-component v-if="connected === 'true'"></header-component>
      <router-view keep-alive></router-view>
    <profil-component v-if="profilShowed === 'true'"></profil-component>
    <footer-component></footer-component>
  </div>
</template>

<script>
import {apiRoot} from '../config/localhost/settings.js'
import HeaderComponent from './components/Header.vue'
import FooterComponent from './components/Footer.vue'
import ProfilComponent from './components/ProfilCPN.vue'
import Notifications from './components/Notifications.vue'

export default {
  components: {
    HeaderComponent,
    FooterComponent,
    ProfilComponent,
    Notifications
  },
  data(){
    return {
      connected: '',
      selectedUser: {
        id : '',
        pseudo: '',
        avatar: '',
        firstname: '',
        lastname: '',
        age: '',
        country: '',
        description: '',
        color: '',
        city: '',
        hobbies: '',
        languages: {
          spokenLang: '',
          learningLang: ''
        }
      },
      profilShowed: '',
      connectedUser: {
        id : '',
        pseudo: '',
        avatar: '',
        firstname: '',
        lastname: '',
        age: '',
        country: '',
        description: '',
        color: '',
        city: '',
        hobbies: '',
        languages: {
          spokenLang: '',
          learningLang: ''
        }
      },
      notifications : []
    }
  },
  created: function(){
    this.profilShowed = "false";
    var pseudo = this.getCookie("PLUME_pseudo");
    if(pseudo != "") {
      this.getUserState(pseudo);
      this.setConnectedUser(pseudo);
    }
  },
  methods: {
    logout: function(){
      document.cookie = "PLUME_pseudo=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
      this.setUserState(this.connectedUser.pseudo, '');
      this.$router.push('/home/');
    },
    getUserState: function(pseudo) {
      var _this = this;

      fetch(apiRoot() + 'Controllers/User/getUserState.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
          if(data[0] == "Error"){
            _this.loginError = data[1];
          }
          else {
            if(data[0] == 2) _this.connected = "true";
            else {
              _this.connected = "";
              _this.logout();
            }
          }
      });
    },
    setUserState: function(pseudo, connected) {
      this.connected = connected;

      var state;
      if(connected == "true") state = 2;
      else state = 1;

      var _this = this;
      fetch(apiRoot() + 'Controllers/User/setUserState.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: pseudo, state: state})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          _this.loginError = data[1];
        }
      });
    },
    getSelectedUser: function(){
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/getUser.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.selectedUser.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error") {

        }
        else {
          _this.selectedUser.pseudo = data['pseudo'];
          _this.selectedUser.avatar = data['avatar'];
          _this.selectedUser.firstname = data['firstname'];
          _this.selectedUser.lastname = data['lastname'];
          _this.selectedUser.age = data['age'];
          _this.selectedUser.country = data['country'];
          _this.selectedUser.city = data['city'];
          _this.selectedUser.description = data['description'];
          _this.selectedUser.color = data['color'];
          _this.selectedUser.hobbies = data['hobbies'];
          _this.selectedUser.languages.learningLang = data['languages']['learningLang']['learningLang'];
          _this.selectedUser.languages.spokenLang = data['languages']['spokenLang']['spokenLang'];
        }

      });
    },
    languagesToFlag: function(country) {
      var flag = {
        Portuguese : '/static/flags/portugal.png',
        English : '/static/flags/united-kingdom.png',
        Chinese : '/static/flags/china.png',
        French : '/static/flags/france.png',
        Japanese : '/static/flags/japan.png',
        German : '/static/flags/germany.png',
        Spanish : '/static/flags/spain.png',
        Italian : '/static/flags/italy.png',
        Russian : '/static/flags/russia.png'
      }
      return flag[country];
    },
    changeSelectedUser: function(pseudo) {
      if(pseudo != '') {
        this.selectedUser.pseudo = pseudo;
        this.getSelectedUser();
        this.profilShowed = "true";
      }
      else {
        this.selectedUser.pseudo = '';
        this.profilShowed = "false";
      }
    },
    getCookie: function(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length,c.length);
        }
      }
      return "";
    },
    setCookie: function(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + "; " + expires;
    },
    setConnectedUser: function(pseudo) {
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/getUser.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error") {
          console.log(data[1]);
        }
        else {
          _this.connectedUser.pseudo = data['pseudo'];
          _this.connectedUser.avatar = data['avatar'];
          _this.connectedUser.firstname = data['firstname'];
          _this.connectedUser.lastname = data['lastname'];
          _this.connectedUser.age = data['age'];
          _this.connectedUser.country = data['country'];
          _this.connectedUser.city = data['city'];
          _this.connectedUser.description = data['description'];
          _this.connectedUser.color = data['color'];
          _this.connectedUser.hobbies = data['hobbies'];
          _this.connectedUser.languages.spokenLang = data['languages']['spokenLang']['spokenLang'];
          _this.connectedUser.languages.learningLang = data['languages']['learningLang']['learningLang'];
        }

      });
    },
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
          _this.notifications = data;
        }
      });
    },
    deleteNotification : function(idNotif) {
      var _this = this;
      fetch(apiRoot() + 'Controllers/Notification/deleteNotif.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({ID : idNotif})
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
    addNotification : function(pseudo1, pseudo2) {
      var _this = this;
      fetch(apiRoot() + 'Controllers/Notification/addNotif.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo1 : pseudo1, pseudo2 : pseudo2, id_notif : 1})
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
    acceptConversation : function(pseudo, idNotif) {
      this.createConversation(pseudo, idNotif);
    },
    refuseConversation : function(idNotif) {
      this.deleteNotification(idNotif);
      this.getNotifications(this.connectedUser.pseudo);
    },
    createConversation : function(pseudo, idNotif) {
      var _this = this;
      var pseudo_conv = [_this.connectedUser.pseudo, pseudo];
      fetch(apiRoot() + 'Controllers/Conversation/createNewConversation.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo_conv : pseudo_conv})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.deleteNotification(idNotif);
          _this.getNotifications(_this.connectedUser.pseudo);
        }
      });
    },
    getLightColor(color){
      if (color == "#6A91C9") {
        return "#D0DBF3";
      }
      if (color == "#BA232A") {
        return "#E19296";
      }
      if (color == "#3AAB3C") {
        return "#ABFF97";
      }
      else {
        return "fff";
      }
      // var colors = [
      //   {
      //     normal : "#6A91C9",
      //     light : "#D0DBF3"
      //   },
      //   {
      //     normal : "#BA232A",
      //     light : "#E19296"
      //   },
      //   {
      //     normal : "#3AAB3C",
      //     light : "#ABFF97"
      //   }
      // ];
      // //Boucle pas bien : a changer
      // for (var coloree in colors) {
      //   if (color == colors[coloree].normal) {
      //     return colors[coloree].light;
      //   }else {
      //     return "erreurboya";
      //   }
      // }
    },
    created: function(){
      this.profilShowed = "false";
      this.getUserState(this.getCookie("PLUME_pseudo"));
      this.setConnectedUser(this.getCookie("PLUME_pseudo"));
    }
  }
}
</script>

  <style lang="scss">
  @import 'assets/scss/reset.css';
  @import 'assets/scss/design.scss';
  </style>
