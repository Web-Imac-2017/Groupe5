<template>
  <div id="app">
    <home-no-connected-view></home-no-connected-view>
  </div>
</template>

<script>
  import HomeNoConnectedView from './views/HomeNoConnected.vue'

  export default {
    components: {
      HomeNoConnectedView
    }
  }
</script>

<style lang="scss">
  @import 'assets/scss/design.scss';
</style>