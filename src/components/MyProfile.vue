<template>
	<div class="myProfile">
		<div class="row">
			<div class="col-sm-4 imageUpdate">
				<img v-bind:src="'http://localhost/PLUME/public_html' + user.avatar">
				<input type="file" v-if="editing == 'true'" name="avatar" id="avatar" v-on:change="addAvatar = 'true'">
				<label v-if="editing == 'true'" for="avatar">IMPORT / CHANGE</label>
				<label v-if="editing == 'true'" v-on:click="deleteAvatar()">DELETE</label>
			</div>
			<div class="col-sm-8">
				<div class="row basicsUpdate">
					<div class="row">
						<div class="col-sm-6 basicsLabel">
							<p>Pseudo</p>
						</div>
						<div class="col-sm-6 basicsFields">
							<p>{{ user.pseudo }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 basicsLabel">
							<p>Firstname</p>
						</div>
						<div class="col-sm-6 basicsFields">
							<p v-if="editing == 'false'">{{ user.firstname }}</p>
							<input v-if="editing == 'true'" type="text" v-model="user.firstname">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 basicsLabel">
							<p>Lastname</p>
						</div>
						<div class="col-sm-6 basicsFields">
							<p v-if="editing == 'false'">{{ user.lastname }}</p>
							<input v-if="editing == 'true'" type="text" v-model="user.lastname">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 basicsLabel">
							<p>City</p>
						</div>
						<div class="col-sm-6 basicsFields">
							<p v-if="editing == 'false'">{{ user.city }}</p>
							<input v-if="editing == 'true'" type="text" v-model="user.city">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 basicsLabel">
							<p>Country</p>
						</div>
						<div class="col-sm-6 basicsFields">
							<p v-if="editing == 'false'">{{ user.country }}</p>
							<select name="country" id="country" v-if="editing == 'true'" v-model="user.country">
								<option v-for="country in countries">{{ country.name }}</option>
							</select>
						</div>
					</div>

					<div class="col-sm-12" id="clickToEdit">
						<p v-if="editing == 'false'" v-on:click="editProfile()">click to edit</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 colorLanguages">
				<p>Your color scheme</p>
				<div :class="user.color"></div>
				<div class="colors" v-for="color in colors">
					<input class="form-check-input" type="radio" :id="color.name" :value="color.normal" name="color" v-model="user.color">
					<label class="form-check-label" v-on:click="colorChecked" :for="color.name" :class="color.name">{{color.name}}</label>
				</div>
				<br/><br/>
				<p>You speak</p>
				<div class="lang" v-for="spokenLang in user.languages.spokenLang">
					<img v-bind:src="'http://localhost/PLUME/public_html' + $parent.languagesToFlag(spokenLang)">
				</div>
				<div v-if="editing == 'true'" class="changeField" v-on:click="addNewSpokenLanguage()">
					<icon name="pencil"></icon>

					<div v-if="addSpokenLanguage == 'true'" v-for="language in languages">
						<input class="form-check-input" type="checkbox" :id="language.name" :value="language.name" v-model="user.languages.spokenLang">
						<label class="form-check-label" :for="language.name" >{{language.name}}</label>
					</div>
				</div>
				<p>You wanna learn</p>
				<div class="lang" v-for="learningLang in user.languages.learningLang">
					<img v-bind:src="'http://localhost/PLUME/public_html' + $parent.languagesToFlag(learningLang)">
				</div>
				<div v-if="editing == 'true'" class="changeField" v-on:click="addNewLearningLanguage()">
					<icon name="pencil"></icon>

					<div v-if="addLearningLanguage == 'true'" v-for="language in languages">
						<input class="form-check-input" type="checkbox" :id="language.name" :value="language.name" v-model="user.languages.learningLang">
						<label class="form-check-label" :for="language.name" >{{language.name}}</label>
					</div>
				</div>

				<p>You love</p>
				<div class="hobbies" :style="{background:$parent.connectedUser.color}" v-for="hobby in user.hobbies">
					{{ hobby }}
				</div>
				<div v-if="editing == 'true'" class="changeField" v-on:click="addNewHobby()">
					<icon name="pencil"></icon>

					<div v-if="addHobby == 'true'" v-for="hobby in hobbies">
						<input class="form-check-input" type="checkbox" :id="hobby.name" :value="hobby.name" v-model="user.hobbies">
						<label class="form-check-label" :for="hobby.name" >{{hobby.name}}</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row" >
			<input type="submit" value="SAVE CHANGES" class="col-sm-12" v-if="editing == 'true'" v-on:click="saveProfile()">
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
			addAvatar : '',
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
		this.init();
	},
	methods: {
		init: function() {
			if(this.$parent.connected != "true") {
        this.$parent.logout();
      }

			this.editing = "false";
			this.addSpokenLanguage = "false";
			this.addLearningLanguage = "false";
			this.changeUserColor = "false";
			this.addHobby = "false";
			this.addAvatar = "false";
			this.getLanguages();
			this.getHobbies();
			this.getCountries();
			this.getColors();

			setTimeout(function()
    	{
      		var el = document.getElementsByClassName("colors");
      		var i;
      		for (i = 0; i < el.length; i++)
      		{
        		var bg = el[i].childNodes[0].getAttribute("value");
        		el[i].childNodes[2].style.backgroundColor = bg;
      		}
    	}, 500);

			this.user = this.$parent.connectedUser;
		},
		editProfile: function() {
			this.editing = "true";
		},
		saveProfile: function() {
			var formCorrect = 1;
			var regexName = new RegExp(/^([A-zÀ-ÿ]){3,30}$/);
			var regexCity = new RegExp(/^([A-zÀ-ÿ]){3,30}$/);

			if(!regexName.test(this.user.firstname)){
				formCorrect = 0;
			}

			if(!regexName.test(this.user.city)){
				formCorrect = 0;
			}

			if(!regexCity.test(this.user.lastname)){
				formCorrect = 0;
			}

			if(formCorrect != 0){
				this.editing = "false";
				this.updateFirstname();
				this.updateLastname();
				this.updateCity();
				this.updateColor();
				this.updateHobbies();
				this.updateLanguages();
				this.updateCountry();
				if(this.addAvatar == 'true') this.updateAvatar();

				this.init();

				this.editing = "false";
			}


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
		colorChecked: function(event)
    	{
      		var el = document.getElementsByClassName("colors");
      		var i;
      		for (i = 0; i < el.length; i++)
      		{
        		el[i].childNodes[2].style.border = "3px solid rgba(0, 0, 0, 0)";
      		}
      		event.target.style.border = "3px solid rgba(0, 0, 0, 1)";
    	},
		addNewSpokenLanguage: function() {
			this.addSpokenLanguage = "true";
		},
		addNewLearningLanguage: function() {
			this.addLearningLanguage = "true";
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
		updateCountry: function() {
			var _this = this;

			fetch(apiRoot() + 'Controllers/User/updateUserCountry.php', {
				method: 'POST',
				headers: {
					'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
					'Content-Type': 'application/json; charset=utf-8'
				},
				dataType: 'JSON',
				body: JSON.stringify({pseudo: _this.user.pseudo, country: _this.user.country[0]})
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
		},
		updateAvatar : function() {
			var form = document.querySelector('#avatar');
			var file = form.files[0];
			var oData = new FormData();
			var im = oData.append("avatar", file);
			var pseudo = oData.append("pseudo", this.user.pseudo);
			this.$http.post(apiRoot() + 'Controllers/Image/uploadAvatar.php', oData);
		},
		deleteAvatar :function(){
			var _this = this;
			fetch(apiRoot() + 'Controllers/User/updateUserAvatar.php', {
				method: 'POST',
				headers: {
					'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
					'Content-Type': 'application/json; charset=utf-8'
				},
				dataType: 'JSON',
				body: JSON.stringify({pseudo: _this.user.pseudo, avatar: "/static/avatar/default.jpg"})
			}).then(function(response) {
				return response.json();
			}).then(function(data){
				if(data[0] == "Error"){
					console.log(data[1]);
				}
				else {
					_this.init();
					_this.$router.push('/myProfile/');
				}
			});
		}
	},
	mounted: function()
	{
		this.init();
	}
}
</script>

<style lang="scss">

.myProfile
{
	width : 50%;
	margin : auto;
	padding-top : 50px;


	.imageUpdate
	{
		img
		{
			width: 100%;
			border: solid 1px #000;
			margin: 5px 0;
		}
		p
		{
			margin-top : 5px;
			font-size : 12px;
			border : 1px solid black;
			padding : 5px;
		}
		input{
			display: none;
		}
		label{
			width: 100%;
			text-align: center;
			border: 1px solid #000;
			padding: 5px;
			font-weight: 600;
			cursor: pointer;
		}
	}

	.basicsUpdate
	{
		.basicsLabel
		{
			font-size : 22px;
			text-align : right;
			font-weight: 400;
		}

		.basicsFields
		{
			font-size : 22px;
			text-align : left;
			font-weight : 600;
			text-transform: capitalize;
		}
		input[type=text]{
			// border: 1px solid #000;
			margin: 3px 0;
			width: 100%;
		}
		select{
			width: 100%;
		}

		#clickToEdit
		{
			text-align : center;
			margin-top : 10px;
			font-size : 15px;
			font-style : italic;
			text-transform: uppercase;
			cursor: pointer;
		}
	}

	.colorLanguages
	{
		width: 100%;

		p
		{
			text-align : left;
			font-size : 22px;
		}

		div
		{
			display: inline-block;
		}

		.changeField
		{
			cursor: pointer;
			.fa-icon{
				width: 20px;
				height: 20px;
			}
		}

		.hobbies
		{
			padding: 2px 10px;
			margin: 6px 6px;
			display: inline-block;
			color: #fff;
			text-transform: uppercase;
			-webkit-border-radius: 2px;
			border-radius: 2px;
			font-size: 1.5em;
		}
	}

	input[type=submit]{
		border: 1px solid #000;
		font-size: 22px;
		font-weight: 600;
		text-transform: capitalize;
		width: 210px;
		text-align: center;
		background: none;
		padding: 0;
		margin: 20px 0;
		position: relative;
		left: 50%;
		transform: translateX(-50%);
	}

	.colors
    {
    	width: 9%;
    	margin-right: 0.9%;

      	& > input
      	{
        	display: none;
      	}
      	& > label
      	{
        	cursor: pointer;
        	margin: 0;
        	color: black;
        	font-weight: 400;
        	padding: 8px 10px;
        	border-radius: 5px;
        	border: 3px solid rgba(0, 0, 0, 0);
        	font-size: 0;
        	width: 100%;
        	height: 50px;
      	}
    }

  .lang img {
    padding: 8px 10px;
    border-radius: 5px;
    width: auto;
    height: 75px;
  }
}
</style>
