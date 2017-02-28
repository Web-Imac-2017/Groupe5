<template>
	<div id="home">
  		<div class="bg" v-bind:style="{backgroundImage: 'url(./static/img/bg.jpg)' }">
  			<div id="centerwrapper">
  				<img v-bind:src="'/static/img/logo.png'" class="homeLogo"><br/>
	    		<router-link v-if="$parent.connected === ''" v-bind:to="'/login/'" class="test" id="sign">
	    			<span>SIGN UP</span>
	    			<p>or</p>
	    			<span>SIGN IN</span>
	    		</router-link>
	    		<a v-if="$parent.connected === 'true'" v-on:click.prevent="$parent.logout">Sign out</a>
  			</div>
  		</div>
  	</div>
</template>

<script>
</script>

<style lang="scss">

.bg
{
	width: 100vw;
	height: 100vh;
	background-size: cover;
	background-position: center center;
	text-align: center;

	#centerwrapper
	{
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translateX(-50%) translateY(-50%);

		.homeLogo
		{
			width: 500px;
			margin-bottom: 30px;
		}

		.test
		{
			color: black;
		}

		.test:hover
		{
			text-decoration: none;
		}

		p
		{
			display: inline-block;
			font-family: Montserrat;
		}

		span
		{
			display: inline-block;
			font-size: 2em;
			font-family: Montserrat;
			transition: .1s;
		}

		span:hover
		{
			transform: scale(1.1);
		}

		span:nth-child(1)
		{
			margin-right: 50px;
		}

		span:nth-child(3)
		{
			margin-left: 50px;
		}
	}
}

#sign span
{
	margin-right : 10px;
	margin-left : 10px;
}

</style>