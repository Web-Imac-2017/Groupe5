<template>
  <div id="home-no-connected">
    <h1>Plume</h1>
    <h2>Page non connecté</h2>
    <connexion-view></connexion-view>
  </div>
</template>

<script>
  import ConnexionView from './Connexion.vue'

  export default {
    components: {
      ConnexionView
    }
  }
</script>

<style lang="scss">

</style>