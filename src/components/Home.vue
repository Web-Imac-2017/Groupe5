<template>
	<div id="home">
		<div class="bg" v-bind:style="{backgroundImage: 'url(http://localhost/PLUME/public_html/static/img/bg.jpg)' }">
			<div id="centerwrapper">
				<img src="http://localhost/PLUME/public_html/static/img/logo.png" class="homeLogo"><br/>
				<router-link v-if="$parent.connected === ''" v-bind:to="'/register/'" id="sign">
					<span>SIGN UP</span>
					<p>or</p>
				</router-link>
				<router-link v-if="$parent.connected === ''" v-bind:to="'/login/'" id="sign">
					<span>SIGN IN</span>
				</router-link>
				<router-link v-bind:to="'/home/'" id="sign">
					<a v-if="$parent.connected === 'true'" v-on:click.prevent="$parent.logout">Sign out</a>
				</router-link>
			</div>
			<router-link class="legal-notice" v-bind:to="'/legalNotice/'">- Legal Notice -</router-link>
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
			margin: 0 50px;
		}

		span:hover
		{
			transform: scale(1.1);
		}
	}
}

#sign span
{
	margin-right : 10px;
	margin-left : 10px;
}

.legal-notice{
	position: fixed;
	bottom: 20px;
	left: 30px;
	font-size: 25px;
}

</style>
