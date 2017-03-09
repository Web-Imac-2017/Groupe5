<template id="matchVue">
	<div class="matchUser">
		<div class="matchUserList">
		<h2 id="matchTitle">Users matched with your profil</h2>
			<ul>
				<li v-for="user in $parent.users" >
					<div class="profilMatch">
						<img v-bind:src="'/static/avatar/' + user[0].infos.avatar" class="avatarProfil">
						<div class="info" :class=getUserState(user)>
							<h3 class="pseudo">{{ user[0].infos.pseudo }} </h3>
							<p>{{ user[0].infos.town }}, {{ user[0].infos.country }}</p>
							<p>{{ user[0].infos.age }} years old</p>
							<icon name="circle"></icon>
						</div>
					</div>
				</li>
			</ul>
		</div>
  
	</div>
	
</template>


<script>

import {apiRoot} from '../../config/localhost/settings.js'
import Header from './Header.vue'

export default {
 
  data () {
    return {
      user:''
    }
  },
  methods : {
  	getUserState: function(user) {
      var theClass = 'userNonConnected';
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/getUserState.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: user.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
          if(data[0] == "Error"){
          }
          else {
            if(data[0] == 2) theClass = "userConnected";
          }
        }
      );
      return theClass;
    }
  }
}

</script>

<style lang="scss">

.info {
	&.userConnected svg {
    color: #38B647;
  }
  &.userNonConnected svg {
    color: #C02029;
  }
}

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