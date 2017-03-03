<template>

  <div class="profil">
    <img v-bind:src="'/static/avatar/' + $parent.selectedUser.avatar" class="avatarProfil">
    <div class="infos">
      <h1 class="pseudo">{{$parent.selectedUser.pseudo}}</h1>
      <p class="name">{{$parent.selectedUser.name}} {{$parent.selectedUser.age}}</p>
      <p class="city" v-if="$parent.selectedUser.city">{{$parent.selectedUser.city}}</p>
      <p class="country">{{$parent.selectedUser.country}}</p>
      <p class="description">{{$parent.selectedUser.description}}</p>
      <ul class="hobbies">
        <li v-for="hobbies in $parent.selectedUser.hobbies">{{hobbies}}</li>
      </ul>
      <div class="language">
        <p class="llabel">I speak</p>
        <ul class="spoken-lang">
          <li v-for="spokenLang in $parent.selectedUser.languages.spokenLang">
            <img v-bind:src="$parent.languagesToFlag(spokenLang.name)">
          </li>
        </ul>
        <p class="llabel">I'm learning</p>
        <ul class="learning-lang">
          <li v-for="learningLang in $parent.selectedUser.languages.learningLang">
            <img v-bind:src="$parent.languagesToFlag(learningLang.name)">
          </li>
        </ul>
      </div>
    </div>
  </div>

</template>

<script>
import {apiRoot} from '../../config/localhost/settings.js';

export default {
  data() {
    return {
    }
  },
  created: function() {
  }
}

</script>

<style lang="scss">
$profil_color: #C3272F;

.profil{
  width: 25%;
  position: absolute;
  top: 0;
  right: 0;
  min-height: 100%;
  box-shadow: 0px 0 40px 0px #706f6f;
  background-color: #fff;

  img.avatarProfil{
    width: 100%;
    border-bottom: 4px $profil_color solid;
  }
  .infos{
    padding: 0 30px 30px;
    font-size: 15px;

    .pseudo{
      text-transform: uppercase;
      font-size: 35px;
      text-align: center;
      font-weight: 900;
    }
    .name, .age, .country, .city{
      margin: 0;
      color: $profil_color;
      text-transform: uppercase;
      text-align: center;
    }
    .description{
      font-style: italic;
      text-align: center;
      padding: 20px 0;
      width: 60%;
      margin: auto;
    }

    ul.hobbies{
      margin: 0 auto;
      text-align: center;
      li{
        background-color: $profil_color;
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
      margin: 100px auto 0;
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
}
</style>
