<template>
  <div id="home">
  	<div class="bg" v-bind:style="{ backgroundImage: 'url(/static/imgCss/Home_BG.jpg)' }"> 
  	</div>
  	<img v-bind:src="'/static/img/logo.png'" class="homeLogo">
    <router-link v-if="$parent.connected === ''" v-bind:to="'/login/'" class="test" id="sign">
    	<span>Sign up</span>
    	<span> | </span>
    	<span>Sign in </span>
    </router-link>
    <a v-if="$parent.connected === 'true'" v-on:click.prevent="$parent.logout">Sign out</a>
  </div>
</template>

<script>
</script>

<style lang="scss">

.homeLogo
{
	width : 200px;
	position : absolute;
	left: 50%;
	top: 35%;
	transform: translateX(-50%) translateY(-50%);
}

.bg
{
	width : 100%;
	height : 100vh;
	background-size: cover;
	background-position : center 100%;
}

.test
{
	text-align : center;
	color : pink;
	position: absolute;
	left: 50%;
	top: 45%;
	transform: translateX(-50%) translateY(-50%);
}

.test:hover
{
	color : white;
	text-decoration: none;
}

#sign span
{
	margin-right : 10px;
	margin-left : 10px;
}

</style>