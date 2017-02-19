<template>
  <header-component></header-component>

  <div class="container profil">
    <div class="row basics">
      <div class="col-md-6">
        <h1 class="pseudo">{{user.pseuso}}</h1>
        <h2 class="name">{{user.name}}</h2>
        <p class="age">{{user.age}}</p>
        <p class="country">{{user.country}}</p>
        <p class="city" v-if="city">{{user.city}}</p>
      </div>
      <div class="col-md-6">
        <img src="" class="avatar" alt="">
      </div>
    </div>
    <div class="row language">
      <ul class="col-md-6 master-lang">
        <li v-for="mLang in user.languages"></li>
      </ul>
      <ul class="col-md-6 learning-lang">
        <li v-for="lLang in user.languages"></li>
      </ul>
    </div>
    <div class="row hobbies">

    </div>
  </div>

  <footer-component></footer-component>
</template>

<script>
import HeaderComponent from './components/Header.vue'
import FooterComponent from './components/Footer.vue'

export default {
  data() {
    return {
      user : {
        pseudo: ''
        name: ''
        age: ''
        country: ''
        city: ''
        languages : {
          mLang : ''
          lLang : ''
        }
        hobbies : {

        }
      }
    }
  },
  components: {
    HeaderComponent,
    FooterComponent
  }
}
</script>

<style lang="css">
</style>
