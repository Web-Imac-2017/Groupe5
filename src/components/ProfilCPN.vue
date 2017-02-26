<template>

  <div class="profil">
    <img v-bind:src="'/static/avatar/' + user.avatar" class="avatar">
    <div class="infos">
      <h1 class="pseudo">{{user.pseudo}}</h1>
      <p class="name">{{user.name}} {{user.age}}</p>
      <p class="city" v-if="user.city">{{user.city}}</p>
      <p class="country">{{user.country}}</p>
      <p class="description">{{user.description}}</p>
      <ul class="hobbies">
        <li v-for="hobbies in user.hobbies">{{hobbies}}</li>
      </ul>
      <div class="language">
        <p class="llabel">I speak</p>
        <ul class="spoken-lang">
          <li v-for="spokenLang in user.languages.spokenLang">
            <img v-bind:src="spokenLang">
          </li>
        </ul>
        <p class="llabel">I'm learning</p>
        <ul class="learning-lang">
          <li v-for="learningLang in user.languages.learningLang">
            <img v-bind:src="learningLang">
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
      "user" : {
        "pseudo": "maureeniz",
        "avatar": "maureeniz.jpg",
        "name": "maureen roche",
        "age": "21",
        "country": "France",
        "city": "bordeaux",
        "description": "Hi :D. If you're looking for a funny french girl to talk to, here I stand !",
        "hobbies" : ["travel", "music", "cinema", "science","arts"],
        "languages" : {
          "spokenLang" : [countryToFlag("french"), countryToFlag("english")],
          "learningLang" : [countryToFlag("spanish"), countryToFlag("chinese"), countryToFlag("german")]
        }
      }
    }
  }

  // var _this = this;
  // fetch(apiRoot() + 'Controllers/User/getUser.php', {
  //   method: 'POST',
  //   headers: {
  //     'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
  //     'Content-Type': 'application/json; charset=utf-8'
  //   },
  //   dataType: 'JSON',
  //   body: JSON.stringify(pseudoUserToGet: //pseudo récupéré de la page précedente)
  // }).then(function(response) {
  //   return response.json();
  // }).then(function(data){
  //   // TRAITEMENT DES DONNEES
  //   _this.user.pseudo = data['pseudo'];
  //   _this.user.name = data['name'];
  //   _this.user.age = data['age'];
  //   _this.user.country = data['country'];
  //   _this.user.city = data['city'];
  //   _this.user.description = data['description'];
  //   _this.user.hobbies = data['hobbies']; //Return tab with hobbies
  //   _this.user.languages.spokenLang = data['spokenLang']; //Return tab with mastered languages
  //   _this.user.languages.learningLang = data['learningLang']; //Return tab with learning languages
  // });
}

function countryToFlag(country) {
  var flag = {
    portuguese : '/static/flags/portugal.png',
    english : '/static/flags/united-kingdom.png',
    chinese : '/static/flags/china.png',
    french : '/static/flags/france.png',
    japanese : '/static/flags/japan.png',
    german : '/static/flags/germany.png',
    spanish : '/static/flags/spain.png'
  }
  return flag[country];
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

  img.avatar{
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
