<template>
	<div class="matchs">
		<div class="col-lg-3 col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
      <div id="infoProfil">
        <img v-bind:src="userActif.avatar" class="avatar">
        <p>connected as<br/><span> {{ userActif.pseudo }} </span></p>
      </div>
      <div id="filterMatch">
        <h2>Filters </h2>
        <div>
            <input v-model="selectedFilter.role"  class="form-check-input" type="radio" value="1" >
            <label  class="form-check-label" for="master">Master</label>
        </div>
        <div>
            <input v-model="selectedFilter.role" class="form-check-input" type="radio" value="2" >
            <label  class="form-check-label" for="apprentices">Apprentices</label><br/>
        </div>
        
        <div>
          <input v-model="selectedFilter.sexMen"  class="form-check-input" type="checkbox" id="women" value="2" >
          <label  class="form-check-label" for="women">Women</label>
        </div>
        
        <div>
          <input v-model="selectedFilter.sexWomen" class="form-check-input" type="checkbox" id="men" value="1" >
          <label  class="form-check-label" for="men">Men</label>
        </div>
        
        
        <div id="rangeSlider">
          <section class="range-slider">
            <input v-model="value[0]" id="doubleRange1" min="15" max="90" step="1" type="range">
            <input v-model="value[1]" id="doubleRange2"  min="15" max="90" step="1" type="range">
          </section>
          <p><span>Years selected : </span> {{ value[0] }} to {{ value[1] }}</p>
        </div>
      </div>
      <div id="btnSM">
        <router-link v-bind:to="'/messages/'" class="btn btn-default" type="button">Quit</router-link>
        <button v-on:click="getSearch()" class="btn btn-default" type="button">Search</button>
      </div>
		</div>
		<div class="col-lg-9 col-lg-offset-0 col-sm-9 col-xs-10 col-xs-offset-1">
			<div class="matchUserList">
        <h2 id="matchTitle">Users matched with your profil</h2>
        <div class="profilMatch col-xs-12 col-lg-6" v-for="user in users" v-on:click="$parent.changeSelectedUser(user[0].infos.pseudo)">
          <img v-bind:src="'/static/avatar/' + user[0].infos.avatar" class="avatarProfil" v-on:click="$parent.changeSelectedUser(user[0].infos.pseudo)">
          <div class="info" :class=getUserState(user)>
            <h3 class="pseudo">{{ user[0].infos.pseudo }} <icon name="circle"></icon></h3>

            <p>{{ user[0].infos.town }}, {{ user[0].infos.country }}</p>
            <p>{{ user[0].infos.age }} years old</p>
            
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

      if(this.value[0] > this.value[1]){
          var tpm = this.value[0];
          this.value[0] = this.value[1];
          this.value[1] = tpm;
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

          _this.$parent.checkAvatar(_this.users);
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
    },
    initSlider : function(){
      // Initialize Sliders
      var sliderSections = document.getElementsByClassName("range-slider");
          for( var x = 0; x < sliderSections.length; x++ ){
            var sliders = sliderSections[x].getElementsByTagName("input");
            for( var y = 0; y < sliders.length; y++ ){
              if( sliders[y].type ==="range" ){
                sliders[y].oninput = getVals;
                // Manually trigger event first time to display values
                sliders[y].oninput();
              }
            }
          }
    }
	},
	created: function() {
		this.userActif = this.$parent.connectedUser;
    this.initSlider();
    if(this.$parent.connected != "true") {
      this.$parent.logout();
    }
  },
  watch: {
    'value' : function(){
        if(this.value[0] > this.value[1]){
          var tpm = this.value[0];
          this.value[0] = this.value[1];
          this.value[1] = tpm;
        }
    }
  }
}




</script>


<style lang="scss">

.matchs{margin-top:20px;}

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
  width: 100%;
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
  margin-bottom: 10px;
  cursor: pointer;
  margin-top: 15px;
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
  margin-right: 10px;
  margin-left:10px;
}

.profilMatch, .info {
  display: inline-block;
}

.pseudo {
  font-size: 22px;
  text-transform: uppercase;
  font-family: arial;
  font-weight: bold;
  margin-top:0;
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
  text-align:center;
}

#infoProfil {
  width: 100%;
  border: 1px solid black;
  p {
    width:43%;
    display: inline-block;
    vertical-align: top;
    margin-top: 20px;
    margin-left: 10%;
    font-family: arial;
    text-align:center;
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
    border:1px solid black;
    display: inline-block;
    vertical-align: top;
    margin: 10px 0 5px 6%;
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
  div{
    display:inline-block;
    width:40%;
  }
  div:nth-child(2), div:nth-child(4){
    margin-left:12%;
  }
}

#btnSM {
  width: 100%;
  margin-top: 20px;
  button, a {
    width: 45%;
    border: 1px solid black;
    border-radius: 0;
    &:nth-child(2) {
      margin-left: 8%;
    }
  }
}

/* slider part */

#filterMatch div:nth-child(6){
  width:80%;
  margin-left:10%;
}

#rangeSlider {
  width:100%;
}

#rangeSlider p span{
  font-weight:bold;
}

 section.range-slider {
    position: relative;
    width: 100%;
    height: 35px;
    text-align: center;
}

 section.range-slider input{
   position:absolute;
   pointer-events:none;
   overflow:hidden;
   outline:none;
   left:0;
   height:18px;
 }

input[type=range] {
  -webkit-appearance: none;
  width: 100%;
  display:block;


}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 1px;
  cursor: pointer;
  box-shadow: px px 0px rgba(0, 0, 0, 0), 0px 0px px rgba(13, 13, 13, 0);
  background: #000000;
  border-radius: 0px;
  border: 0px solid #010101;
}
input[type=range]::-webkit-slider-thumb {
  box-shadow: 0px 0px 0px rgba(0, 0, 0, 0), 0px 0px 0px rgba(13, 13, 13, 0);
  border: 0px solid rgba(0, 0, 0, 0);
  height: 18px;
  width: 3px;
  border-radius: 0px;
  background: #000000;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -8.5px;
  pointer-events: all;
  position:relative;
  z-index:1;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #0d0d0d;
}
input[type=range]::-moz-range-track {
   width: 100%;
  height: 1px;
  cursor: pointer;
  box-shadow: px px 0px rgba(0, 0, 0, 0), 0px 0px px rgba(13, 13, 13, 0);
  background: #000000;
  border-radius: 0px;
  border: 0px solid #010101;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 0px 0px 0px rgba(0, 0, 0, 0), 0px 0px 0px rgba(13, 13, 13, 0);
  border: 0px solid rgba(0, 0, 0, 0);
  height: 18px;
  width: 3px;
  border-radius: 0px;
  background: #000000;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -8.5px;
  pointer-events: all;
  position:relative;
  z-index:10;

}
input[type=range]::-ms-track {
  width: 100%;
  height: 1px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #000000;
  border: 0px solid #010101;
  border-radius: 0px;
  box-shadow: px px 0px rgba(0, 0, 0, 0), 0px 0px px rgba(13, 13, 13, 0);
}
input[type=range]::-ms-fill-upper {
  background: #000000;
  border: 0px solid #010101;
  border-radius: 0px;
  box-shadow: px px 0px rgba(0, 0, 0, 0), 0px 0px px rgba(13, 13, 13, 0);
}
input[type=range]::-ms-thumb {
  box-shadow: 0px 0px 0px rgba(0, 0, 0, 0), 0px 0px 0px rgba(13, 13, 13, 0);
  border: 0px solid rgba(0, 0, 0, 0);
  height: 18px;
  width: 3px;
  border-radius: 0px;
  background: #000000;
  cursor: pointer;
  height: 1px;
}
input[type=range]:focus::-ms-fill-lower {
  background: #000000;
}
input[type=range]:focus::-ms-fill-upper {
  background: #0d0d0d;
}




</style>