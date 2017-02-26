<template>

  <div class="container profil">
    <div class="row basics">
      <p>PROFIL</p>
      <div class="col-md-6">
        <h1 class="pseudo">{{user.pseudo}}</h1>
        <h2 class="name">{{user.name}}</h2>
        <p class="age">{{user.age}}</p>
        <p class="country">{{user.country}}</p>
        <p class="city" v-if="user.city">{{user.city}}</p>
      </div>
      <div class="col-md-6">
        <img src="" class="avatar" alt="">
      </div>
    </div>
    <div class="row language">
      <p>LANGUAGES</p>
      <p>Mastered languages</p>
      <ul class="col-md-6 master-lang">
        <li v-for="mLang in user.languages.masterLang">{{mLang}}</li>
      </ul>
      <p>Learning Languages</p>
      <ul class="col-md-6 learning-lang">
        <li v-for="learningLang in user.languages.lLang">{{lLang}}</li>
      </ul>
    </div>
    <div class="row hobbies">
      <p>HOBBIES</p>
      <ul class="col-md-6">
        <li v-for="hobbies in user.hobbies">{{hobbies}}</li>
      </ul>
    </div>
  </div>

</template>

<script>
import {apiRoot} from '../../config/localhost/settings.js';

export default {
  data() {
    return {
      "user" : {
        "pseudo": "coucoucnous",
        "name": "Jane Doe",
        "age": "22",
        "country": "France",
        "city": "Paris",
        "languages" : {
          "masterLang" : ["Francais", "English"],
          "learningLang" : ["Spanish"]
        },
        "hobbies" : ["Couture", "Moto", "Sport"]
      }
    }
  }

  // var _this = this;
  // fetch(apiRoot() + 'Controllers/User/getUser.php', {
  //     method: 'POST',
  //     headers: {
  //     'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
  //     'Content-Type': 'application/json; charset=utf-8'
  //     },
  //     dataType: 'JSON',
  //     body: JSON.stringify(pseudoUserToGet: //pseudo récupéré de la page précedente)
  //   }).then(function(response) {
  //     return response.json();
  //   }).then(function(data){
  //     // TRAITEMENT DES DONNEES
  //     _this.user.pseudo = data['pseudo'];
  //     _this.user.name = data['name'];
  //     _this.user.age = data['age'];
  //     _this.user.country = data['country'];
  //     _this.user.city = data['city'];
  //     _this.user.languages.masterLang = data['masterLang']; //Return tab with mastered languages
  //     _this.user.languages.learningLang = data['learningLang']; //Return tab with learning languages
  //     _this.user.hobbies = data['hobbies']; //Return tab with hobbies
  //   }
  });
}
</script>

<style lang="css">
</style>
