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
          <p id="error_Genre" class="errorMsg">You must select an gender</p>
        </div>

        <!-- FIRST NAME -->
        <input name="firstName" type="text" minlength="3" maxlength="20" required="required" placeholder="FIRST NAME" v-model="user.firstname"  />
        <p id="error_FirstName" class="errorMsg">This field is not correct. It must have between 3 and 20 characters</p>

        <!-- LAST NAME -->
        <input name="lastName" type="text" minlength="3" maxlength = "20" required="required" placeholder="LAST NAME" v-model="user.name"  />
        <p id="error_LastName" class="errorMsg">This field is not correct. It must have between 3 and 20 characters</p>

        <!-- AGE -->
        <input name="age" id="age" type="number" min="16" max="120" required="required" placeholder="YOUR AGE" v-model="user.age"/>
        <p id="error_Age" class="errorMsg">This age is not correct. Minimum 16 years</p>

        <!-- PSEUDO -->
        <input id="pseudo" name="pseudo" type="text" minlength="3" maxlength="20" required="required" placeholder="USERNAME" v-model="user.pseudo" />
        <p id="error_Pseudo" class="errorMsg">This field is not correct. It must have between 3 and 20 characters</p>

        <!-- EMAIL -->
        <input name="email" id="email" type="email" required="required" placeholder="YOUR EMAIL" v-model="user.email" />
        <p id="error_Mail" class="errorMsg">This mail is not correct</p>

        <!-- PWD -->
        <input name="pwd1" id="pwd1" required="required" type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" placeholder="PASSWORD" v-model="user.password"  />
        <p id="error_Psw" class="errorMsg">This password is not sure</p>


        <input name="pwd2" required="required" id="pwd2" type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" placeholder="CONFIRM PASSWORD" v-model="user.password2" />
        <p id="error_Psw2" class="errorMsg">This fiels is not correct. It must be the same as password field</p>


        <!-- COUNTRY -->
        <label id="countryLabel" class="form-text" for="country">Your country</label>
        <br />
        <select name="country" id="country" v-model="user.country">
          <option v-for="value in countryList">{{ value.name }}</option>
        </select>

        <!-- CITY -->
        <label class="form-text" for="city">Your city</label>
        <input id="city" v-model="user.city"></input>
        <span class="tooltip">What city do you live in ?</span>

        <!-- COLOR THEME -->
        <div id="colorwrapper" class="form-group">
          <label class="form-check-label" for="color">Your theme color</label><br/>
          <div class="colors" v-for="color in colorsList">
            <input class="form-check-input" type="radio" :id="color.name" :value="color.name" name="color" v-model="user.color">
            <label class="form-check-label" :for="color.name" :class="color.name" v-on:click="colorChecked"></label>
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
        password2:'',
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
      var formCorrect = 1;
      //Regex Definition
      var regexName = new RegExp("^([a-zA-Z0-9_-]){3,30}$","i");
      var regexEmail = new RegExp("^([a-zA-Z0-9_-])+([.]?[a-zA-Z0-9_-]{1,})*@([a-zA-Z0-9-_]{2,}[.])+[a-zA-Z]{2,3}\\s*$","i");
      var regexPSW = new RegExp("^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$");
      //simple security
      /* other possibilities
      regex password ++ : "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
      Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet and 1 Number:
      regex password +++ :
      Minimum 8 and Maximum 10 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character
      */
      //verification for gender
      if(!((user.sex == 1) || (user.sex == 2) || (user.sex == 3))){
        formCorrect = 0;
        document.getElementById("error_Genre").style.display = 'block';
      }else{
        document.getElementById("error_Genre").style.display = 'none';
      }
      //verification for firstname
      if(!regexName.test(user.firstname)){
        formCorrect = 0;
        document.getElementById("error_FirstName").style.display = 'block';
      }else{
        document.getElementById("error_FirstName").style.display = 'none';
      }
      //verification for lastname
      if(!regexName.test(user.name)){
        formCorrect = 0;
        document.getElementById("error_LastName").style.display = 'block';
      }
      else{
        document.getElementById("error_LastName").style.display = 'none';
      }
      //verification age
      if(user.age < 16 || user.age > 120){
        formCorrect = 0;
        document.getElementById("error_Age").style.display = 'block';
      }
      else{
        document.getElementById("error_Age").style.display = 'none';
      }
      //verification pseudo
      if(!regexName.test(user.pseudo)){
        formCorrect = 0;
        document.getElementById("error_Pseudo").style.display = 'block';
      }
      else{
        document.getElementById("error_Pseudo").style.display = 'none';
      }
      //verification mail
      if(!regexEmail.test(user.email)){
        formCorrect = 0;
        document.getElementById("error_Mail").style.display = 'block';
      }else{
        document.getElementById("error_Mail").style.display = 'none';
      }
      //verification password1
      if(!regexPSW.test(user.password)){
        formCorrect = 0;
        document.getElementById("error_Psw").style.display = 'block';
      }else{
        document.getElementById("error_Psw").style.display = 'none';
      }
      //verification password2
      if( user.password != user.password2){
        formCorrect = 0;
        document.getElementById("error_Psw2").style.display = 'block';
      }else{
        document.getElementById("error_Psw2").style.display = 'none';
      }

      if(formCorrect != 0){
        document.getElementById("error_Genre").style.display = 'none';
        document.getElementById("error_FirstName").style.display = 'none';
        document.getElementById("error_LastName").style.display = 'none';
        document.getElementById("error_Age").style.display = 'none';
        document.getElementById("error_Pseudo").style.display = 'none';
        document.getElementById("error_Mail").style.display = 'none';
        document.getElementById("error_Psw").style.display = 'none';
        document.getElementById("error_Psw2").style.display = 'none';
        document.getElementById("error_Country").style.display = 'none';

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
    colorChecked: function(event)
    {
      event.target.style.border = "5px solid black";
    }
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
</script>

<style lang="scss">
#error_Genre, #error_FirstName, #error_LastName, #error_Age, #error_Pseudo, #error_Mail, #error_Psw, #error_Psw2, #error_Country{
  display:none;
}
.errorMsg{
  color:red;
}
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

    input#pseudo, label#countryLabel
    {
      margin-top: 30px;
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
