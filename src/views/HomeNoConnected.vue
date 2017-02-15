<template>
  <div id="home-no-connected">
    <h1>Plume</h1>
    <h2>Page non connecté</h2>
    <connexion-component></connexion-component>
  </div>
</template>

<script>
  import ConnexionComponent from './../components/Connexion.vue'

  export default {
    components: {
      ConnexionComponent
    }
  }
</script>

<style lang="scss">

</style>