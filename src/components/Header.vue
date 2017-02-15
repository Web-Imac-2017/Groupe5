<template>
	<div class="header">
		<menu-component></menu-component>
		<form>
      <input type="submit" value="Sign out">
    </form>   
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


