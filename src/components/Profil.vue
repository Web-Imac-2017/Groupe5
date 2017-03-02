<template>

  <div class="container profil">
    <div class="row basics">
      <p>PROFIL</p>
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
      <p>LANGUAGES</p>
      <p>Mastered languages</p>
      <ul class="col-md-6 master-lang">
        <li v-for="mLang in user.languages"></li>
      </ul>
      <p>Learning Languages</p>
      <ul class="col-md-6 learning-lang">
        <li v-for="lLang in user.languages"></li>
      </ul>
    </div>
    <div class="row hobbies">
      <p>HOBBIES</p>
      <ul class="col-md-6">
        <li v-for="hobbies in user"></li>
      </ul>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      user : {
        pseudo: 'Hellowizz',
        name: 'Héloïse',
        age: '',
        country: '',
        city: '',
        languages : {
          mLang : [],
          lLang : []
        },
        hobbies : []
      }
    }
  }
}
</script>

<style lang="css">
</style>
