<template>
	<div>
		<div class="col-sm-3">
			<search-match-component></search-match-component>
		</div>
		<div class="col-sm-9">
			<match-component></match-component>
		</div>
	</div>
	
</template>
	

<script>

import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'
import MatchComponent from './MatchCPN.vue'
import SearchMatchComponent from './searchMatchCPN.vue'

export default{
	data : function (){
		return{
			selectedFilter : [],
			users : [],
			isConnected : 'true',
			userActif: '',
			master:''

		}
	},
	components: {
		MatchComponent,
		SearchMatchComponent
	},
	methods: {
		getUserMatchInit: function(){
  		var _this = this;
  		        fetch(apiRoot() + 'Controllers/User/getUserMatch.php', {
	          method: 'POST',
	          headers: {
	            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
	            'Content-Type': 'application/json; charset=utf-8'
	          },
	          dataType: 'JSON',
	          body: JSON.stringify({ filters : _this.userActif.learningLang})
	        }).then(function(response) {
	          return response.json();
	        }).then(function(data){
	          if(data[0] == "Error"){
	            console.log("ERREUR !!");
	          }
	          else {
	            _this.users = data['users'];

            	console.log("les users : " + _this.users);
          	}
        	});
  		},
  		getSearch: function(){
  			var men = document.getElementById('searchBox_master');

  			if(men.isChecked()){
  				alert("c'est coché");
  			}

  			getUserMatch();

  		},
		getUserMatch: function(filters){
  		var _this = this;
  		        fetch(apiRoot() + 'Controllers/User/getUserMatch.php', {
	          method: 'POST',
	          headers: {
	            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
	            'Content-Type': 'application/json; charset=utf-8'
	          },
	          dataType: 'JSON',
	          body: JSON.stringify({ selectedFilter : filters })
	        }).then(function(response) {
	          return response.json();
	        }).then(function(data){
	          if(data[0] == "Error"){
	            console.log("ERREUR !!");
	          }
	          else {
	            _this.users = data['users'];

            	console.log("les users : " + _this.users);
          	}
        	});
  		},

  		getUserConnexion : function(pseudo){
  			var _this = this;
  		        fetch(apiRoot() + 'Controllers/User/getUserState.php', {
	          method: 'POST',
	          headers: {
	            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
	            'Content-Type': 'application/json; charset=utf-8'
	          },
	          dataType: 'JSON',
	          body: JSON.stringify({ pseudo : this.pseudo })
	        }).then(function(response) {
	          return response.json();
	        }).then(function(data){
	          if(data[0] == "Error"){
	            console.log("ERREUR !!");
	          }
	          else {
	          	if(data == 1){
	          		console.log("la data est : " + data);
	          		return true;
	          	}else{
	          		console.log("la data est : " + data);
	          		return false;
	          	}

          	}
        	});

  		},
  		getUserActif: function(){
  		var _this = this;
  		        fetch(apiRoot() + 'Controllers/User/getUserActif.php', {
	          method: 'POST',
	          headers: {
	            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
	            'Content-Type': 'application/json; charset=utf-8'
	          },
	          dataType: 'JSON',
	          body: JSON.stringify({  })
	        }).then(function(response) {
	          return response.json();
	        }).then(function(data){
	          if(data[0] == "Error"){
	            console.log("ERREUR !!");
	          }
	          else {
	            _this.userActif = data['userActif'];

          	}
        	});
  		}

	},
	created: function() {
		this.getUserActif();
  		this.getUserMatchInit();
  		
  		
  	}
}


</script>