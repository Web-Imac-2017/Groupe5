<template>
  <div id="app">
    <header-component></header-component>
    <router-view keep-alive></router-view>
    <footer-component></footer-component>
  </div>
</template>

<script>
  import HeaderComponent from './components/Header.vue'
  import FooterComponent from './components/Footer.vue'

  export default {
    components: {
      HeaderComponent,
      FooterComponent
    }
  }
</script>

<style lang="scss">
  @import 'assets/scss/design.scss';
</style>