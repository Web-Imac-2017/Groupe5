<template>
	<div class="searchMatch">
		<div id="infoProfil">
			<img v-bind:src="'/static/avatar/' + $parent.userActif.avatar" class="avatar">
			<p>connected as<br/><span> {{ $parent.userActif.pseudo }} </span></p>
		</div>
		<div id="filterMatch">
			<h2>Filters </h2>
			<input v-model="$parent.selectedFilter"  class="form-check-input" type="checkbox" id="women" value="Women" >
      <label  class="form-check-label" for="women">Women</label>
      <input v-model="$parent.selectedFilter" class="form-check-input" type="checkbox" id="men" value="Men" >
      <label  class="form-check-label" for="men">Men</label>
		</div>
    {{  $parent.selectedFilter }}
		<div id="btnSM">
			<button class="btn btn-default" type="button">Quit</button>
			<button v-on:click="$parent.getUserMatch()" class="btn btn-default" type="button">Search</button>
		</div>
		


	</div>

</template>

<script>

import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'

export default {
  data () {
    return {
      	user : {
      		pseudo : 'thePseudo',
	      	avatar : '',
	      	lastName : '',
	      	firstName : '',
	      	age : '',
	      	country : '',
	      	description : '',
	      	languages : {
	            spokenLang : [],
	            learningLang : []
	        },
		    hobbies : []
      	},
      	users : ''

       }

  },
  methods : {
  	getUser: function(){
  		var _this = this;
  		        fetch(apiRoot() + 'Controllers/User/getUserActif.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            console.log("ERREUR !!");
          }
          else {
            _this.users = data['users'];
          }
        });
  	}
  },
  created: function() {
  	this.getUser();
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

</style>