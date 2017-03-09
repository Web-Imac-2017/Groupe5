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
import MatchComponent from './MatchCPN.vue'
import SearchMatchComponent from './SearchMatchCPN.vue'

export default{
	data : function (){
		return{
			selectedFilter : {
				role: '',
				sex: ''
			},
			users : [],
			userActif: '',
			master:''

		}
	},
	components: {
		MatchComponent,
		SearchMatchComponent
	},
	methods: {
		/*getUserMatchInit: function(){
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
      	}
    	});
		},*/
		getSearch: function(){
			this.getUserMatch();
		},
		getUserMatch: function(){
  		var _this = this;
  		var role;
		  fetch(apiRoot() + 'Controllers/User/getUserMatch.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo : _this.userActif.pseudo, role: _this.selectedFilter.role})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log("ERREUR !!");
        }
        else {
        	console.log(data);
          _this.users = data['users'];
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
		}
	},
	created: function() {
		this.userActif = this.$parent.connectedUser;
  	//this.getUserMatchInit();
  }
}


</script>