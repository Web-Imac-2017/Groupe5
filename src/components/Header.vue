<template>
	<div class="header">
		<menu-component></menu-component>
		<router-link v-bind:to="'/login/'">Login</router-link>
	</div>
</template>s

<script>
	import MenuComponent from './Menu.vue'

	export default {
    components: {
  		MenuComponent
  	}
	}
</script>

<style type="scss">

</style>


