<template id="matchVue">
	<div class="matchUser">
		<div class="matchUserList">
		<h2 id="matchTitle">Users matched with your profil</h2>
		<ul>
			<li v-for="user in $parent.users" >
				<div v-on:click="displayUserInfo(user)"  class="profilMatch">
					<img v-bind:src="'/static/avatar/' + user.avatar" class="avatarProfil">
					<div class="info">
						<h3 class="pseudo">{{ user.pseudo }} </h3>{{isConnected}}
						
						<p>{{ user.city }} , {{ user.country }}</p>
						
						<p>{{ user.age }} years old</p>


						
					</div>
					<div  v-bind:class="[{isConnected} ? activeClass : '', connectedState]"></div>


				</div>

			</li>
		</ul>
		</div>
		<div class="detailOfUser" id="detailUser">
			<img v-bind:src="'/static/avatar/' + detailUser.avatar" class="avatarProfilDetail">
			<div class="infoDetail">
				<h3 class="pseudo">{{ detailUser.pseudo }} 
					<div  v-bind:class="[{isConnected} ? activeClass : '', connectedState]"></div>
				</h3>
				

				<p>Last Name :  {{ detailUser.lastname }}</p>
				<p>First Name {{ detailUser.firstname }}</p>
				<p>Age :  {{ detailUser.age }}</p>
				<p>City :  {{ detailUser.city }}</p>
				<p>Country :  {{ detailUser.country }}</p>
				<p>Description {{ detailUser.description }}</p>
				<ul>
					<li v-for="hobbies in user.hobbies"> {{ hobbies }} </li>
				</ul>
			</div>
			<div class="languages">
				<p>Languages spoken : </p>
				<ul>
					<li v-for="spokenLang in detailUser.spokenLang">
						{{ spokenLang }}
					</li>
				</ul>
				<p>Languages learning : </p>
				<ul>
					<li v-for="lLang in detailUser.learningLang">
						{{ lLang }}
					</li>
				</ul>
			</div>


		</div>
   
	</div>
	
</template>


<script>

import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'

export default {
 
  data () {
    return {
      user:'',
      isConnected :'',
      activeClass : 'activeConnect',
      connectedState : 'connectedState',
      detailUser: {
        pseudo: '',
        avatar:'',
        firstname:'',
        lastname:'',
        age: '',
        country: '',
        city: '',
        description:'',
        spokenLang : [],
        learningLang : [],
        hobbies : []
      }

    }
  },
  computed : {
  	getUserConnexion : function(pseudo){
  			var _this = this;
  		        fetch(apiRoot() + 'Controllers/User/getUserState.php', {
	          method: 'POST',
	          headers: {
	            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
	            'Content-Type': 'application/json; charset=utf-8'
	          },
	          dataType: 'JSON',
	          body: JSON.stringify({ pseudo : pseudo })
	        }).then(function(response) {
	          return response.json();
	        }).then(function(data){
	          if(data[0] == "Error"){
	            console.log("ERREUR !!");
	          }
	          else {

	          	

	          		console.log("la data est : " + data);
	          	if(data == 1){
	          		_this.isConnected = true;
	          		//return true;
	          	}else{
	          		_this.isConnected = false;
	          		//return false;
	          	}

          	}
        	});

  		}

  },
  methods : {
  	displayUserInfo : function(user){

  		document.getElementById('detailUser').style.display = 'inline-block';

  		this.detailUser.pseudo = user.pseudo;
  		this.detailUser.avatar = user.avatar;
  		this.detailUser.lastname = user.lastname;
  		this.detailUser.firstname = user.firstname;
  		this.detailUser.age = user.age;
  		this.detailUser.hobbies = user.hobbies;
  		this.detailUser.spokenLang = user.spokenLang;
  		this.detailUser.learningLang = user.learningLang;

  	}
  }
}



</script>

<style lang="scss">

.matchUser{
	width:100%;
}
.matchUserList{
	width:65%;
	display:inline-block;
	vertical-align:top;
}

.matchUser h2{
	width:100%;
	text-align:center;
}

.matchUser li{
	list-style:none;
	width:48%;
	display:inline-block;
	margin-right:2%;
}

.profilMatch{
	width:100%;
	margin-bottom:10px;
	cursor:pointer;
}

.profilMatch:hover{
	background:whitesmoke;
}

.profilMatch p{
	font-style:italic;
}

.connectedState{
	width:15px;
	height: 15px;
	background:grey;
	border-radius:100%;
	display:inline-block;
	vertical-align:top;
	margin-top:17px;
}

.activeConnect{
	background:green;
}
.noActiveConnect{
	background:red;
}

.avatarProfil{
	width:80px;
	height:80px;
	margin-right:15px;

}

.info{
	vertical-align:top;
	margin-top:15px;
	margin-right:10px;
}
.profilMatch, .info{
	display: inline-block;
}

.pseudo{
	font-size: 22px;
	text-transform: uppercase;
	font-family: arial;
	font-weight:bold;
}

.detailOfUser{
	width:33%;
	border: 1px solid black;
	display:inline-block;
	padding:15px
}

.avatarProfilDetail{
	width:40%;
	height:auto;
	margin-left:30%;
	margin-bottom:15px;
}

.infoDetail{
	width:100%;
	height:auto;
}

.infoDetail h3{
	width:100%;
	text-align:center;
	margin-bottom:15px;
}

.infoDetail h3 div{
	margin-top:4px;
}

#detailUser{
	display:none;
}

#matchTitle{
	font-size:25px;
	font-family: arial;
	margin-top:15px;
	margin-bottom:15px;
}

</style>