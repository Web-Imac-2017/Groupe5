<template>
  	<div class="register">
  		<div class="wrapper">

  			<!-- BG -->
  			<div class="bg" v-bind:style="{backgroundImage: 'url(/static/img/bg.jpg)' }"></div>
		
			<!-- TITLE -->
        	<h1 class="maintitle">{{ msgRegistration }}</h1>

        	<form id="formRegistration" method="post" action="" v-on:submit.prevent>

	            <!-- AVATAR -->
	            <div id="chargeImg">
	                <div v-if="!user.avatar">
	                    <input type="file" name="file" id="file" class="inputfile" />
	                    <label class="filebutton" for="file" v-bind:style="{backgroundImage: 'url(../../static/img/import.png'}"></label>
	                    <br/>
	                    <p class="filebuttontext">Import your avatar</p>
	                </div>
	                <div v-else>
	                    <img :src="user.avatar" />
	                    <button @click="">Remove image</button>
	                </div>
	            </div>

	            <!-- SEX -->
	            <div class="form-group">            
	                <label class="form-check-label" for="sex">You are</label><br/>
	                <div id="woman" class="type">
		                <input class="form-check-input check" type="radio" value="1" v-model="user.sex"><br />
		                <label class="form-check-label" for="woman">A woman</label>	
	                </div><div id="man" class="type">     
		                <input class="form-check-input check" type="radio" value="2" v-model="user.sex"><br />
		                <label class="form-check-label" for="man">A man</label>
	                </div><div id="other" class="type">
		                <input class="form-check-input check" type="radio" value="3" v-model="user.sex"><br />
		                <label class="form-check-label" for="other">Other</label>
	                </div>
	            </div>
	            
	            <!-- FIRST NAME -->
	            <input name="firstName" type="text" minlength="2" maxlength="20" required="required" placeholder="FIRST NAME" v-model="user.firstname"  />
	            <span class="tooltip">This field must have between 2 and 20 characters</span>
	            
	            <!-- LAST NAME -->
	            <input name="lastName" type="text" minlength="2" maxlength = "20" required="required" placeholder="LAST NAME" v-model="user.name"  />
	            <span class="tooltip">This field must have minimum 2 characters</span>

	            <!-- AGE -->
	            <input name="age" id="age" type="number" min="16" max="120" required="required" placeholder="YOUR AGE" v-model="user.age" />
	            <span class="tooltip">You have to be between 16 and 120 years old</span>

	            <!-- PSEUDO -->
	            <input name="pseudo" type="text" minlength="5" maxlength = "20" required="required" placeholder="USERNAME" v-model="user.pseudo" />
	            <span class="tooltip">The username must have minimum 2 characters</span>
	        
	            <!-- EMAIL -->
	            <input name="email" id="email" type="email" required="required" placeholder="YOUR EMAIL" v-model="user.email" />

	            <!-- PWD -->
	            <input name="pwd1" id="pwd1" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" placeholder="PASSWORD" v-model="user.password" />
	            <span class="tooltip errorPseudo">Your pwd must have at least 6 characters</span>

	            <input name="pwd2" id="pwd2" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" placeholder="CONFIRM PASSWORD" />
	            <span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>

	            <!-- COUNTRY -->
	            <label class="form-text" for="country">Your country</label>
	            <br />
	            <select name="country" id="country" v-model="user.country">
	            	<option v-for="value in countryList">{{ value.name }}</option>
	        	</select>
	            <span class="tooltip">Please choose your home country</span>

	            <!-- CITY -->
	            <label class="form-text" for="city">Your city</label>
	            <input id="city" v-model="user.city"></input>
	            <span class="tooltip">What city do you live in ?</span>

	            <!-- COLOR THEME -->
	            <div id="colorwrapper" class="form-group">            
	                <label class="form-check-label" for="color">Your theme color</label><br/>
                  	<div class="colors" v-for="color in colorsList">
                    	<input class="form-check-input" type="radio" :id="color.name" :value="color.name" name="color" v-model="user.color">
                    	<label class="form-check-label" :for="color.name" :class="color.name" onclick="colorChecked(this)"></label>
                  	</div>
	            </div>

	            <!-- SUBMIT -->
	            <button id="submitbutton" type="submit" value="Register" v-on:click="submitForm(user)"></button>
	            <label id="submitbuttonlabel" for="submitbutton">I'M READY</label>
	            <!-- <button type="reset" value="Reinit form">Reinit</button> -->
        	</form>
        </div>
    </div>
</template>

<script>
    import {apiRoot} from '../../config/localhost/settings.js'
	export default {
	  	name: 'registration',
	  	data () {
	    	return {
	      		msgRegistration: 'WELCOME',
	      		titleForm : 'Registration',
	      		countryList: [],
	      		user : {
	      			firstname:'',
	      			name:'',
			        pseudo:'',
			        age:'',
		            email:'',
			        password:'',
			        country:'',
		            avatar: '',
		            sex: '',
		            color: '',
		            description: '',
			        city:'',
			        languages : {
              			spokenLang : [],
              			learningLang : []
            		},
	        		hobbies : []
	      		},
	      		hobbiesList: [],
	      		languagesList: [],
            colorsList: []
	    	}
	  	},
      	methods: {
        submitForm: function(user){
            var form = document.getElementById("formRegistration");
            var sizeM = user.languages.spokenLang.length;
            var sizeL = user.languages.learningLang.length;
            var errorM = document.getElementById("errorLanguageM");
            var errorL = document.getElementById("errorLanguageL");

            if (sizeM == 0 || sizeL == 0 ){
                if (sizeM == 0){
                	errorM.style.opacity = 1;
                }
                if (sizeL == 0){
                   	errorL.style.opacity = 1;
                }
            }
            else {
                errorM.style.opacity = 0;
                errorL.style.opacity = 0;
                //form.submit();

                var _this = this;
                
                fetch(apiRoot() + 'Controllers/User/setUserProfil.php', {
                  	method: 'POST',
                  	headers: {
                    	'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
                    	'Content-Type': 'application/json; charset=utf-8'
                  	},
                  	dataType: 'JSON',
                  	body: JSON.stringify({lastname : _this.user.name, firstname: _this.user.firstname, pseudo: _this.user.pseudo, age: _this.user.age, email: _this.user.email, password: _this.user.password, country: _this.user.country, city: _this.user.city, languages: _this.user.languages, hobbies: _this.user.hobbies, avatar: _this.user.avatar, color: _this.user.color, sex: _this.user.sex, description: _this.user.description})
                }).then(function(response){
                  	return response.json();
                }).then(function(data){

                  if(data[0] == "Error"){
                    console.log(data[1]);
                  }
                  else {
                    _this.$parent.setCookie("PLUME_pseudo", _this.user.pseudo, 10);
            				_this.$parent.setUserState(_this.user.pseudo, "true");
            				_this.$parent.setConnectedUser(_this.$parent.getCookie("PLUME_pseudo"));
            				console.log(_this.$parent.connectedUser);
            				_this.$router.push('/home/');
                  }
                });
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
              _this.languagesList = data['languages'];
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
              _this.hobbiesList = data['hobbies'];
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
              _this.countryList = data['countries'];
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
              _this.colorsList = data['colors'];
            }
          });
        },
      },
      created: function() {
      	this.getLanguages();
      	this.getHobbies();
      	this.getCountries();
        this.getColors();
      }
	}

	// basic javascript

	function desactivateTooltips()
	{
	    var tooltips = document.querySelectorAll('.tooltip'),
	    tooltipsLength = tooltips.length;
	    for (var i = 0; i < tooltipsLength; i++)
	    {
	        tooltips[i].style.display = 'none';
	    }

	}

	function getTooltip(elements)
	{
	    while (elements = elements.nextSibling)
	    {
	        if (elements.className === 'tooltip') return elements;
	    }
	    return false;
	}

	function colorChecked(element)
	{
		element.css("border", "3px solid black");
	}

</script>

<style lang="scss">

    .register
    {
        font-family: Montserrat;
        width: 100vw;
        height: 100vh;
        margin: 0;
        text-align: center;
        position: absolute;
        overflow-x: hidden;
        color: black;

        .wrapper
        {
        	.bg
        	{
	        		width: 100vw;
	        	height: 100vh;
	        	position: fixed;
	        	top: 0;
	        	z-index: -5;
        	}
        }

        .maintitle
        {
            margin-top: 120px;
            margin-bottom: 40px;
            font-size: 3em;
            font-weight: 700;
            letter-spacing: 5px;
        }

        form
        {
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            width: 400px;

            label
            {
            	font-size: 1.5em;
            	font-weight: 400;
            	margin-bottom: 10px;
            }

            input
            {
                width: 100%;
                height: 40px;
                font-size: 1.5em;
                padding: 0 5px;
                font-weight: 600;
                margin-bottom: 8px;
                border: 3px solid #333333;
            }
            
            input#age, input#pwd2
            {
            	margin-bottom: 30px;
            }

            .inputfile
            {
                display: none;
            }

            .filebutton
            {
                background-color: rgb(140, 190, 230);
                width: 100px;
                height: 100px;
                border-radius: 50%;
                cursor: pointer;
                transition: .2s;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
                
                &:hover
                {
                    background-color: rgb(170, 220, 255);
                }
            }

            .filebuttontext
            {
                margin-bottom: 35px;
                font-size: 0.8em;
                font-style: italic;
            }

            select#country
            {
            	width: 100%;
            	height: 40px;
            	border: 3px solid black;
            	font-size: 1.5em;
            	margin-bottom: 20px;
            }

            .type
            {
            	display: inline-block;
            	width: 33.333%;
            	margin: 0;
            	text-align: center;

            	& > label
            	{
            		font-size: 1em;
            	}

            	& > br
            	{
            		height: 10px;
            	}

            	.check
            	{
            		width: 30px;
            	}
            }

            .colors
            {
            	display: inline-block;
            	margin: 1px 4px;

            	& > input
            	{
            		display: none;
            	}

            	& > label
            	{
            		cursor: pointer;
            		width: 70px;
            		height: 50px;
            		margin: 0;
            	}
            }

            #city, #colorwrapper, #description
            {
            	margin-bottom: 20px;
            }

            #submitbutton
            {
            	display: none;
            }

            #submitbuttonlabel
            {
            	margin-top: 50px;
            	margin-bottom: 120px;
            	font-size: 3em;
            	padding: 0 15px;
            	background-color: rgba(255, 255, 255, .6);
            	border: 3px solid black;
            	cursor: pointer;
            	font-weight: 900;
            	transition: .1s;

            	&:hover
            	{
            		transform: scale(1.05);
            	}
            }
        }
    }

</style>
