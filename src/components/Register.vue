<template>
  <div class="register">
  	<h1>{{ msgRegistration }}</h1>
    <h2>{{ titleForm }}</h2>

    <form class="col-sm-5" id="formRegistration" method="post" action="" v-on:submit.prevent>

        <label class="form-text" for="firstName">First Name* :</label>
        <input class="form-control" name="firstName" id="firstName" type="text" minlength="2" maxlength="30" required="required" v-model="user.firstname"  />
        <p>{{ user.firstname }}</p>
        <span class="tooltip">Lastname must have minimum 2 characters</span>
        <br /><br />

        <label class="form-text" for="lastName">Name* :</label>
        <input class="form-control" name="lastName" id="lastName" type="text" minlength="2" maxlength = "30" required="required" v-model="user.name"  />
        <p>{{ user.name }}</p>
        <span class="tooltip">Lastname must have minimum 2 characters</span>
        <br /><br />

        <label class="form-text" for="pseudo">Pseudo* :</label>
        <input class="form-control" name="pseudo" id="login" type="text" minlength="2" maxlength = "30" required="required" v-model="user.pseudo" />
        <p>{{ user.pseudo }}</p>
        <br /><br />

        <div id="chargeImg">
            <div v-if="!image">
                 <label class="form-text" for="avatar">Select your avatar :</label>
                <input class="form-control-file" type="file" @change="">
            </div>
            <div v-else>
                <img :src="image" />
                <button @click="">Remove image</button>
            </div>
        </div>
        <br/><br/>

        <label class="form-text" for="age">Age* :</label>
        <input class="form-control" name="age" id="age" type="number" min="2" max="120" required="required" v-model="user.age" />
        <p>{{ user.age }}</p>
        <span class="tooltip">The age has to be between 15 and 120 years</span>
        <br /><br />

        <label class="form-text" for="email">Email* :</label>
        <input class="form-control" name="email" id="email" type="email"  required="required" v-model="user.email" />
        <p>{{ user.email }}</p>
        <br /><br />

        <label class="form-text" for="pwd1">Password :</label>
        <input class="form-control" name="pwd1" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" id="pwd1" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.pwd2.pattern = this.value;" v-model="user.password" />
        <p>{{ user.password }}</p>
        <span class="tooltip errorPseudo">Le mot de passe ne doit pas faire moins de 6 caractères</span>

        <br /><br />

        <label class="form-text" for="pwd2">Password (confirmation) :</label>
        <input class="form-control" name="pwd2" title="Please enter the same Password as above" id="pwd2" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" onchange="  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" />
        <span class="tooltip">Le mot de passe de confirmation doit être identique à celui d'origine</span>
        <br /><br />


        <label class="form-text" for="country">Country :</label>
        <select class="form-control" name="country" id="country" v-model="user.country">
        	<option v-for="value in countryList">{{ value }}</option>
    	</select>
    	<p>{{ user.country }}</p>
        <span class="tooltip">Vous devez sélectionner votre pays de résidence</span>
        <br /><br />

        <label class="form-text" for="city">City :</label>
        <input class="form-control" v-model="user.city"></input>
    	<p>{{ user.city }}</p>
        <span class="tooltip">Vous devez sélectionner votre pays de résidence</span>
        <br/><br/>

        <div class="form-group">            
            <label class="form-check-label" for="languageM">Language(s) spoken* :</label><br/>
            <span class="errorSpan displayNo" id="errorLanguageM">You have to select one language</span><br/>
             <input class="form-check-input" type="checkbox" id="english" value="English" v-model="user.languages.mLang">
            <label class="form-check-label" for="english">English</label>
            <input class="form-check-input" type="checkbox" id="French" value="French" v-model="user.languages.mLang">
            <label  class="form-check-label"for="french">French</label>
            <input class="form-check-input" type="checkbox" id="spanish" value="Spanish" v-model="user.languages.mLang">
            <label class="form-check-label" for="spanish">Spanish</label>
            <br>
            <span>Checked languages:</span>
            <span v-for="value in user.languages.mLang"> {{ value }} </span>
		    </div>
        <br/><br/>

        <div class="form-group">
            <label class="form-check-label" for="languageL">Language(s) you want to learn* :</label><br/>
            <span class="errorSpan displayNo" id="errorLanguageL">You have to select one language</span><br/>
             <input class="form-check-input" type="checkbox" id="english" value="English" v-model="user.languages.lLang">
            <label class="form-check-label" for="english">English</label>
            <input class="form-check-input"  type="checkbox" id="French" value="French" v-model="user.languages.lLang">
            <label class="form-check-label" for="french">French</label>
            <input  class="form-check-input" type="checkbox" id="spanish" value="Spanish" v-model="user.languages.lLang">
            <label class="form-check-label" for="spanish">Spanish</label>
            <br>
            <span>Checked languages:</span>
            <span v-for="value in user.languages.lLang"> {{ value }} </span>
        </div>
        <br/><br/>

        <div class="form-group">
            <label lass="form-check-label" for="hobbies">Interest center(s) :</label><br/>

             <input class="form-check-input" type="checkbox" id="music" value="Music" v-model="user.hobbies">
            <label class="form-check-label" for="music">Music</label><br/>
             <input type="checkbox" id="cinema" value="Cinema" v-model="user.hobbies">
            <label class="form-check-label" for="cinema">Cinema</label><br/>
             <input class="form-check-input" type="checkbox" id="travel" value="Travel" v-model="user.hobbies">
            <label class="form-check-label" for="travel">Travel</label><br/>
             <input class="form-check-input" type="checkbox" id="arts" value="Arts" v-model="user.hobbies">
            <label for="arts">Arts</label><br/>
            
            <br>
            <span>Checked hobbies:</span>
            <span v-for="value in user.hobbies"> {{ value }} </span>

        </div>

        <span class="form_col col-sm-4"></span>
        <button type="submit" value="Register" v-on:click="submitForm(user)">Register</button> <button type="reset" value="Reinit form">Reinit</button>

    </form>
  </div>

</template>

<script>

	export default {
	  name: 'registration',
	  data () {
	    return {
	      msgRegistration: 'Welcome to Plume Registration ',
	      titleForm : 'Registration',
	      countryList: [
	      		"Afghanistan",
	      		"Algeria",
	      		"Australia",
	      		"Brasil",
	      		"Canada",
	      		"France",
	      		"Japan",
	      		"Germany",
	      		"Spain"
	      		]
	      ,
	      user : {
	      	firstname:'',
	      	name:'',
	        pseudo:'',
	        age:'',
            email:'',
	        password:'',
	        country:'',
	        city:'',
	        languages : {
              mLang : [],
              lLang : []
            },
	        hobbies : []
	      },
	    }
	  },
      methods:{
        submitForm: function(user){
            var form = document.getElementById("formRegistration");
            var sizeM = user.languages.mLang.length;
            var sizeL = user.languages.lLang.length;
            var errorM = document.getElementById("errorLanguageM");
            var errorL = document.getElementById("errorLanguageL");

            if(sizeM == 0 || sizeL == 0 ){
                if(sizeM == 0){
                   errorM.style.opacity = 1;
                }
                if(sizeL == 0){
                   errorL.style.opacity = 1;
                }
            }else{
                errorM.style.opacity = 0;
                errorL.style.opacity = 0;
                form.submit();
            }
        }

      }
	}


//basic javascript

function desactivateTooltips() {

    var tooltips = document.querySelectorAll('.tooltip'),
        tooltipsLength = tooltips.length;

    for (var i = 0; i < tooltipsLength; i++) {
        tooltips[i].style.display = 'none';
    }

}

function getTooltip(elements) {
    while (elements = elements.nextSibling) {
        if (elements.className === 'tooltip') {
            return elements;
        }
    }
    return false;
}

</script>

<style type="scss">
    .displayYes{opacity:1;}
    .displayNo{opacity:0;}
    .errorSpan{color:red;}
</style>
