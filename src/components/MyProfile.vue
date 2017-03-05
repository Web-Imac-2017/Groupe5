<template>

	<div class="myProfile">

      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-4 imageProfile">
              <img v-bind:src="'/static/avatar/maureeniz.jpg'"><br/>
              <p>IMPORT / CHANGE</p>
              <p>DELETE</p>
            </div>
            <div class="col-lg-8">
              <div class="row informationProfile">
              	<div class="col-lg-6 nameInformation">
              		<p>USERNAME</p>
		            <p>FIRSTNAME</p>
		            <p>LASTNAME</p>
		            <p>CITY</p>
		            <p>COUNTRY</p>
              	</div>
              	<div class="col-lg-6 information">
              		<p>Maureeniz</p>
              		<p>Maureen</p>
              		<p>Roche</p>
              		<p>Bordeaux</p>
              		<p>France</p>
              	</div>

              	<div class="col-lg-12" id="clickToEdit">
              		<p>click to edit</p>
              	</div>

              </div>
            </div>
          </div>
      </div>
   	</div>

    <div class="row">
      <div class="col-lg-12 colorLanguages">
        <p>Your color scheme</p>
        	<div id="color1"></div>
        	<div id="color2"></div>
        	<div id="color3"></div>
        	<div id="color4"></div>
        	<div id="color5"></div>
        	<div id="color6"></div>
        	<div id="color7"></div>
        	<div id="color8"></div>
        <p>You speak</p>
        	<div id="lang1"></div>
        	<div id="lang2"></div>
        	<div id="lang3"></div>
        	<div id="langPlus"></div>
        <p>You wanna learn</p>
      </div>
    </div>

    </div>

</template>

<script>
import {apiRoot} from '../../config/localhost/settings.js'
export default {
  data() {
    return {
    }
  }
}
</script>

<style lang="scss">

.myProfile
{
	width : 50%;
	margin : auto;
	padding-top : 50px;
	img
	{
		width: 100%;
		border: 1px solid black;
	}
}

.imageProfile
{
	p
	{
		margin-top : 5px;
		font-size : 12px;
		border : 1px solid black;
		padding : 5px;
	}
}

.informationProfile
{
	padding : 30px;
	padding-top : 50px;
	.nameInformation
	{
		font-size : 25px;
		text-align : right;
	}

	.information p
	{
		font-size : 25px;
		text-align : left;
		font-weight : 900;
	}

	#clickToEdit
	{
		text-align : center;
		margin-top : 10px;
		font-size : 15px;
		font-style : italic;
	}
}

.colorLanguages
{
	text-align : left;
	padding : 15px;

	p
	{
		text-align : left;
		font-size : 25px;
	}

	div
	{
		margin-top : 10px;
		margin-right : 20px;
		margin-bottom : 10px;
		width : 55px;
		height : 25px;
		display : inline-block;
		background-size: cover;
	}

	#color1
	{
		background-color : red;
	}

	#color2
	{
		background-color : pink;
	}

	#color3
	{
		background-color : yellow;
	}

	#color4
	{
		background-color : orange;
	}

	#color5
	{
		background-color : brown;
	}

	#color6
	{
		background-color : black;
	}

	#color7
	{
		background-color : grey;
	}

	#color8
	{
		background-color : purple;
	}

	#lang1
	{
		background-color : purple;
	}

	#lang2
	{
		background-color : purple;
	}

	#lang3
	{
		background-color : purple;
	}

	#langPlus
	{
		background-color : grey;
	}
}
</style>
