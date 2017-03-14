<template>
	<div class="matchs">
		<div class="col-sm-3">
      <div id="infoProfil">
        <img v-bind:src="userActif.avatar" class="avatar">
        <p>connected as<br/><span> {{ userActif.pseudo }} </span></p>
      </div>
      <div id="filterMatch">
        <h2>Filters </h2>
        <p style="display:inline-block">You search : </p>

        <input v-model="selectedFilter.role"  class="form-check-input" type="radio" value="1" >
        <label  class="form-check-label" for="master">Master</label>
        
        <input v-model="selectedFilter.role" class="form-check-input" type="radio" value="2" >
        <label  class="form-check-label" for="apprentices">Apprentices</label>
        
        <input v-model="selectedFilter.sexMen"  class="form-check-input" type="checkbox" id="women" value="2" >
        <label  class="form-check-label" for="women">Women</label>
        
        <input v-model="selectedFilter.sexWomen" class="form-check-input" type="checkbox" id="men" value="1" >
        <label  class="form-check-label" for="men">Men</label>
        
        <div id="rangeSlider">
          <vue-slider ref="slider" v-model="value"></vue-slider>
        </div>
      </div>
      <div id="btnSM">
        <button class="btn btn-default" type="button">Quit</button>
        <button v-on:click="getSearch()" class="btn btn-default" type="button">Search</button>
      </div>
		</div>
		<div class="col-sm-9">
			<div class="matchUserList">
        <h2 id="matchTitle">Users matched with your profil</h2>
        <div class="profilMatch col-sm-3" v-for="user in users">
          <img v-bind:src="user[0].infos.avatar" class="avatarProfil" v-on:click="$parent.changeSelectedUser(user[0].infos.pseudo)">
          <div class="info" :class=getUserState(user)>
            <h3 class="pseudo">{{ user[0].infos.pseudo }} </h3>
            <p>{{ user[0].infos.town }}, {{ user[0].infos.country }}</p>
            <p>{{ user[0].infos.age }} years old</p>
            <icon name="circle"></icon>
          </div>
        </div>
      </div>
		</div>
	</div>
	
</template>
	

<script>

import {apiRoot} from '../../config/localhost/settings.js'
import vueSlider from 'vue-slider-component';

export default{
	data : function (){
		return{
			selectedFilter : {
				role: 1,
				sexMen: 1,
        sexWomen: 1
			},
			users : [],
      userActif : {},
      value: [10,90],

		}
	},
	components: {
		vueSlider
	},
	methods: {
		getSearch: function(){
			this.getUserMatch();
		},
		getUserMatch: function(){
      this.users = [];
      var _this = this;
      var sex = [];
      if(document.getElementById("men").checked) {
        sex.push(document.getElementById("men").value);
      }      
      if(document.getElementById("women").checked) {
        sex.push(document.getElementById("women").value);
      }
     
      fetch(apiRoot() + 'Controllers/User/getUserMatch.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo : _this.userActif.pseudo, role: _this.selectedFilter.role, sex: sex, minAge: Math.min(_this.value[0]), maxAge: Math.max(_this.value[1])})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          for(var i = 0; i < data.length; i ++) {
            if(data[i]["users"].length > 0) {
              _this.users.push(data[i]["users"]);
            }
          }
        }
      });
		},
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
	},
	created: function() {
		this.userActif = this.$parent.connectedUser;
  }
}


</script>


<style lang="scss">

info {
  &.userConnected svg {
    color: #38B647;
  }
  &.userNonConnected svg {
    color: #C02029;
  }
}

.matchUser {
  width: 100%;
}

.matchUserList {
  width: 65%;
  display: inline-block;
  vertical-align: top;
}

.matchUser {
  h2 {
    width: 100%;
    text-align: center;
  }
  li {
    list-style: none;
    width: 48%;
    display: inline-block;
    margin-right: 2%;
  }
}

.profilMatch {
  width: 100%;
  margin-bottom: 10px;
  cursor: pointer;
  &:hover {
    background: whitesmoke;
  }
  p {
    font-style: italic;
  }
}

.connectedState {
  width: 15px;
  height: 15px;
  background: grey;
  border-radius: 100%;
  display: inline-block;
  vertical-align: top;
  margin-top: 17px;
}

.activeConnect {
  background: green;
}

.noActiveConnect {
  background: red;
}

.avatarProfil {
  width: 80px;
  height: 80px;
  margin-right: 15px;
}

.info {
  vertical-align: top;
  margin-top: 15px;
  margin-right: 10px;
}

.profilMatch, .info {
  display: inline-block;
}

.pseudo {
  font-size: 22px;
  text-transform: uppercase;
  font-family: arial;
  font-weight: bold;
}

.detailOfUser {
  width: 33%;
  border: 1px solid black;
  display: inline-block;
  padding: 15px;
}

.avatarProfilDetail {
  width: 40%;
  height: auto;
  margin-left: 30%;
  margin-bottom: 15px;
}

.infoDetail {
  width: 100%;
  height: auto;
  h3 {
    width: 100%;
    text-align: center;
    margin-bottom: 15px;
    div {
      margin-top: 4px;
    }
  }
}

#detailUser {
  display: none;
}

#matchTitle {
  font-size: 25px;
  font-family: arial;
  margin-top: 15px;
  margin-bottom: 15px;
}

#infoProfil {
  width: 100%;
  border: 1px solid black;
  p {
    display: inline-block;
    vertical-align: top;
    margin-top: 20px;
    margin-left: 10%;
    font-family: arial;
    span {
      font-size: 20px;
      text-transform: uppercase;
      font-weight: bold;
    }
  }
  img {
    width: 60px;
    height: 60px;
    border-radius: 100%;
    background: blue;
    display: inline-block;
    vertical-align: top;
    margin: 5px 0 5px 6%;
  }
}

#filterMatch {
  width: 100%;
  border: 1px solid black;
  margin-top: 20px;
  padding: 15px;
  h2 {
    width: 100%;
    font-size: 20px;
    text-align: center;
    text-transform: uppercase;
    margin-top: 0;
    font-family: arial;
    margin-bottom: 15px;
  }
}

#btnSM {
  width: 100%;
  margin-top: 20px;
  button {
    width: 45%;
    border: 1px solid black;
    border-radius: 0;
    &:nth-child(2) {
      margin-left: 8%;
    }
  }
}

#rangeSlider {
  margin-top: 30px;
}

</style>