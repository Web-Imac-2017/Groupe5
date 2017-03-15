<template>
  <div class="Profil">
    <div class="overlay" v-on:click="$parent.changeSelectedUser('')"></div>
    <div class="profilCPN">
      <div class="avatarProfil" :style="{borderBottom:4+'px '+'solid '+ $parent.selectedUser.color,backgroundImage:'url(/static/avatar/' + $parent.selectedUser.avatar+')'}">
      </div>
      <div class="infos">
        <h1 class="pseudo">{{$parent.selectedUser.pseudo}}</h1>
        <p class="name" :style="{color:$parent.selectedUser.color}">{{$parent.selectedUser.firstname}} {{$parent.selectedUser.lastname}} {{$parent.selectedUser.age}}</p>
        <p class="city" :style="{color:$parent.selectedUser.color}" v-if="$parent.selectedUser.city">{{$parent.selectedUser.city}}</p>
        <p class="country" :style="{color:$parent.selectedUser.color}">{{$parent.selectedUser.country}}</p>
        <p class="description">{{$parent.selectedUser.description}}</p>
        <ul class="hobbies">
          <li v-for="hobbies in $parent.selectedUser.hobbies" :style="{background:$parent.selectedUser.color}">{{hobbies}}</li>
        </ul>
        <div class="language">
          <p class="llabel">I speak</p>
          <ul class="spoken-lang">
            <li v-for="spokenLang in $parent.selectedUser.languages.spokenLang">
              <img v-bind:src="$parent.languagesToFlag(spokenLang)">
            </li>
          </ul>
          <p class="llabel">I'm learning</p>
          <ul class="learning-lang">
            <li v-for="learningLang in $parent.selectedUser.languages.learningLang">
              <img v-bind:src="$parent.languagesToFlag(learningLang)">
            </li>
          </ul>
        </div>
        <button name="talk" class="talkButton" v-bind:style="{border:1+'px '+'solid '+ $parent.selectedUser.color,color:$parent.selectedUser.avatar}" v-on:click="$parent.addNotification($parent.connectedUser.pseudo, $parent.selectedUser.pseudo)">Talk !</button>
      </div>
    </div>
  </div>

</template>

<script>
import {apiRoot} from '../../config/localhost/settings.js'
export default {
  data: function() {
    return {
    }
  },
  methods: {

  },
  created: function() {
  }
}

</script>

<style lang="scss">
.overlay{
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0,0,0,0.5);
}
.profilCPN{
  width: 350px;
  position: absolute;
  top: 0;
  right: 0;
  min-height: 100%;
  // box-shadow: 0px 0 40px 0px #706f6f;
  background-color: #fff;

  .avatarProfil{
    width: 100%;
    height: 220px;
    overflow: hidden;
    background-size: cover;
    background-position: center center;
  }
  .infos{
    padding: 0 20px 30px;
    font-size: 15px;

    .pseudo{
      text-transform: uppercase;
      font-size: 35px;
      text-align: center;
      font-weight: 900;
    }
    .name, .country, .city{
      margin: 0;
      text-transform: uppercase;
      text-align: center;
    }
    .description{
      font-style: italic;
      text-align: center;
      padding: 20px 0;
      width: 80%;
      margin: auto;
    }

    ul.hobbies{
      margin: 0 auto;
      text-align: center;
      li{
        padding: 2px 6px;
        margin: 6px 6px;
        display: inline-block;
        color: #fff;
        text-transform: uppercase;
        -webkit-border-radius: 2px;
        border-radius: 2px;
      }
    }
    .language{
      position: relative;
      bottom: 0;
      margin: 50px auto 0;
      .llabel{
        font-style: italic;
        margin: 0;
      }
      li{
        display: inline-block;
        margin: 0 6px;
        img{
          width: 60px;
        }
      }
    }
  }
  .talkButton{
    margin: auto;
    padding: 5px 15px;
    text-transform: uppercase;
    border-radius: 2px;
    text-align: center;
    display: block;
  }
}


</style>
