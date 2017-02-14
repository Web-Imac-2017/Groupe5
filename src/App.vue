<template>
  <div id="app">
  	<header-component></header-component>
    <h1>Hello Vue!</h1>
  </div>
</template>

<script>
	import HeaderComponent from './components/Header.vue'

	export default {
    components: {
  		HeaderComponent
  	}
	}
</script>

<style lang="scss">
  @import 'assets/scss/design.scss';
</style>