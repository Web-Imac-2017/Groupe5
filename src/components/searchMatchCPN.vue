<template>
	<div class="searchMatch">
		<div id="infoProfil">
			<img v-bind:src="'/static/avatar/' + user.avatar" class="avatar">
			<p>connected as<br/><span> {{ user.pseudo }} </span></p>
		</div>
		<div id="filterMatch">
			<h2>Filters </h2>
			<p style="display:inline-block">You search : </p>

			<input v-model="$parent.selectedFilter.role"  class="form-check-input" type="radio" value="1" >
	    <label  class="form-check-label" for="master">Master</label>
	    
	    <input v-model="$parent.selectedFilter.role" class="form-check-input" type="radio" value="2" >
	    <label  class="form-check-label" for="apprentices">Apprentices</label>
			
			<input v-model="$parent.selectedFilter.sex"  class="form-check-input" type="checkbox" id="women" value="Women" >
		  <label  class="form-check-label" for="women">Women</label>
		  
		  <input v-model="$parent.selectedFilter.sex" class="form-check-input" type="checkbox" id="men" value="Men" >
		  <label  class="form-check-label" for="men">Men</label>
		  
		  <div id="rangeSlider">
    		<vue-slider v-model="value" :min="10" :max="90" ></vue-slider>
    	</div>
		</div>
		<div id="btnSM">
			<button class="btn btn-default" type="button">Quit</button>
			<button v-on:click="$parent.getSearch()" class="btn btn-default" type="button">Search</button>
		</div>
		


	</div>

</template>

<script>

import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'
import vueSlider from 'vue-slider-component';

export default {
  data () {
    return {
    	user : {},
    	users : '',
    	value: [10,90],
    }
  },
  methods : {
  },
  created: function() {
  	this.user = this.$parent.userActif;
  },
  components:{
  	vueSlider
  }


}


</script>

<style lang="scss">

#infoProfil{
	width:100%;
	border: 1px solid black;
}

#infoProfil p{
	display:inline-block;
	vertical-align:top;
	margin-top:20px;
	margin-left:10%;
  font-family:arial;

}

#infoProfil p span{
	font-size:20px;
	text-transform: uppercase;
  font-weight:bold;
}

#infoProfil img{
	width:60px;
	height:60px;
	border-radius:100%;
	background:blue;
	display:inline-block;
	vertical-align:top;
	margin : 5px 0 5px 6%;
}

#filterMatch{
	width:100%;
	border: 1px solid black;
	margin-top:20px;
	padding:15px;
}

#filterMatch h2{
	width:100%;
	font-size:20px;
	text-align:center;
	text-transform:uppercase;
	margin-top:0;
  font-family:arial;
  margin-bottom:15px;

}

#btnSM{
	width:100%;
	margin-top:20px;
}

#btnSM button{
	width:45%;
	border:1px solid black;
	border-radius:0;
}

#btnSM button:nth-child(2){
	margin-left:8%;
}

#rangeSlider{
	margin-top:30px;
}

</style>