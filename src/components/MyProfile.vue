<template>

	<div class="myProfile">

    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-4 imageProfile">
            <img v-bind:src="'/static/avatar/maureeniz.jpg'"><br/>
            <p v-if="editing == 'true'">IMPORT / CHANGE</p>
            <p v-if="editing == 'true'">DELETE</p>
          </div>
          <div class="col-sm-8">
            <div class="row informationProfile">
            	<div class="col-sm-6 nameInformation">
            		<p>USERNAME</p>
		            <p>FIRSTNAME</p>
		            <p>LASTNAME</p>
		            <p>CITY</p>
		            <p>COUNTRY</p>
            	</div>
            	<div class="col-sm-6 information">
            		<p>{{ user.pseudo }}</p>
            		<p v-if="editing == 'false'">{{ user.firstname }}</p>
            		<p v-if="editing == 'false'">{{ user.lastname }}</p>
            		<p v-if="editing == 'false'">{{ user.city }}</p>
            		<p v-if="editing == 'false'">{{ user.country[0] }}</p>
            		<input v-if="editing == 'true'" type="text" v-model="user.firstname">
            		<input v-if="editing == 'true'" type="text" v-model="user.lastname">
            		<input v-if="editing == 'true'" type="text" v-model="user.city">
            		<input v-if="editing == 'true'" type="text" v-model="user.country[0]">
            	</div>

            	<div class="col-sm-12" id="clickToEdit">
            		<p v-if="editing == 'false'" v-on:click="editProfile()">click to edit</p>
            	</div>   
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 colorLanguages">
        <p>Your color scheme</p>
        	<div :class="user.color"></div>
        	<div v-if="editing == 'true'" class="changeField" v-on:click="changeColor()">
        		<div class="form-group">  
	        		<div v-if="changeUserColor == 'true'" v-for="color in colors">
			          <input class="form-check-input" type="radio" :id="color.name" :value="color.name" name="color" v-model="user.color">
			          <label class="form-check-label" :for="color.name" :class="color.name">{{color.name}}</label>
		          </div>
		        </div>
        	</div>
        <p>You speak</p>
        	<div class="lang" v-for="spokenLang in user.languages.spokenLang">
        		<img v-bind:src="$parent.languagesToFlag(spokenLang)">
        	</div>
        	<div v-if="editing == 'true'" class="changeField" v-on:click="addNewSpokenLanguage()">
        		<div v-if="addSpokenLanguage == 'true'" v-for="language in languages">
		          <input class="form-check-input" type="checkbox" :id="language.name" :value="language.name" v-model="user.languages.spokenLang">
		          <label class="form-check-label" :for="language.name" >{{language.name}}</label>
	          </div>
        	</div>
        <p>You wanna learn</p>
          <div class="lang" v-for="learningLang in user.languages.learningLang">
        		<img v-bind:src="$parent.languagesToFlag(learningLang)">
        	</div>
        	<div v-if="editing == 'true'" class="changeField" v-on:click="addNewLearningLanguage()">
						<div v-if="addLearningLanguage == 'true'" v-for="language in languages">
		          <input class="form-check-input" type="checkbox" :id="language.name" :value="language.name" v-model="user.languages.learningLang">
		          <label class="form-check-label" :for="language.name" >{{language.name}}</label>
	          </div>
        	</div>

        	<p>You love</p>
          <div class="lang" v-for="hobby in user.hobbies">
        		{{ hobby }}
        	</div>
        	<div v-if="editing == 'true'" class="changeField" v-on:click="addNewHobby()">
						<div v-if="addHobby == 'true'" v-for="hobby in hobbies">
		          <input class="form-check-input" type="checkbox" :id="hobby.name" :value="hobby.name" v-model="user.hobbies">
		          <label class="form-check-label" :for="hobby.name" >{{hobby.name}}</label>
	          </div>
        	</div>
      </div>
    </div>
		<div class="row" v-if="editing == 'true'" v-on:click="saveProfile()">
			<div class="col-sm-12">SAVE CHANGES</div>
		</div>


  </div>

</template>

<script>
import {apiRoot} from '../../config/localhost/settings.js'
export default {
  data() {
    return {
    	editing: '',
    	user: '',
    	addSpokenLanguage: '',
    	addLearningLanguage: '',
    	addHobby: '',
    	changeUserColor: '',
    	colors: [],
    	languages: [],
    	hobbies: [],
    	countries: []
    }
  },
  created: function() {
  	this.editing = "false";
  	this.addSpokenLanguage = "false";
  	this.addLearningLanguage = "false";
  	this.changeUserColor = "false";
  	this.addHobby = "false";
  	this.getLanguages();
    this.getHobbies();
    this.getCountries();
    this.getColors();

  	this.user = this.$parent.connectedUser;
  }, 
  methods: {
  	editProfile: function() {
  		this.editing = "true";
  	},
  	saveProfile: function() {
  		this.editing = "false";
  		this.updateFirstname();
  		this.updateLastname();
  		this.updateCity();
			this.updateColor();
			this.updateHobbies();
			this.updateLanguages();
  	},
  	getLanguages: function() {
    	var _this = this;
            
      fetch(apiRoot() + 'Controllers/General/getAllLanguages.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON'
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.languages = data['languages'];
        }
      });
    },
    getHobbies: function() {
    	var _this = this;
            
      fetch(apiRoot() + 'Controllers/General/getAllHobbies.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON'
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.hobbies = data['hobbies'];
        }
      });
    },
    getCountries: function() {
    	var _this = this;
            
      fetch(apiRoot() + 'Controllers/General/getAllCountries.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON'
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.countries = data['countries'];
        }
      });
    },
    getColors: function() {
    	var _this = this;
            
      fetch(apiRoot() + 'Controllers/General/getAllColors.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON'
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {
          _this.colors = data['colors'];
        }
      });
    },
    addNewSpokenLanguage: function() {
    	this.addSpokenLanguage = "true";
    },
    addNewLearningLanguage: function() {
    	this.addSpokenLanguage = "true";
    },
    addNewHobby: function() {
    	this.addHobby = "true";
    },
    changeColor: function() {
    	this.changeUserColor = "true";
    },
    updateFirstname: function() {
    	var _this = this;
                
      fetch(apiRoot() + 'Controllers/User/updateUserFirstname.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, firstname: _this.user.firstname})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });
    },
    updateLastname: function() {
    	var _this = this;
                
      fetch(apiRoot() + 'Controllers/User/updateUserLastname.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, lastname: _this.user.lastname})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });
    },
    updateCity: function() {
    	var _this = this;
                
      fetch(apiRoot() + 'Controllers/User/updateUserCity.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, city: _this.user.city})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });
    },
    updateColor: function() {
    	var _this = this;
                
      fetch(apiRoot() + 'Controllers/User/updateUserColor.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, color: _this.user.color})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });
    },
    updateHobbies: function() {
    	var _this = this;
                
      fetch(apiRoot() + 'Controllers/User/setUserHobbies.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, hobbies: _this.user.hobbies})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });
    },
    updateLanguages: function() {
    	var _this = this;
                
      fetch(apiRoot() + 'Controllers/User/setUserLang.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, languages: _this.user.languages.learningLang, level: 1})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });

      fetch(apiRoot() + 'Controllers/User/setUserLang.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo: _this.user.pseudo, languages: _this.user.languages.spokenLang, level: 2})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log(data[1]);
        }
        else {

        }
      });
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

	.changeField
	{
		background-color : grey;
	}
}
</style>
