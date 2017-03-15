<template lang="html">
    <div class="searchBar">
        <div class="input-group bar">
            <input type="text" class="form-control" placeholder="If u're looking for someone..." v-model="search" id="searchUser">
            <span class="input-group-btn">
                <button v-on:click="searchUsers" class="btn btn-default" type="button">Go</button>
            </span>
        </div>
        <div class="col-md-12 result">
            <div v-for="user in users" class="col-md-4 resultitem">
                <h1>{{user.pseudo}}</h1>
                <h2>Spoken languages</h2>
                <ul>
                    <li v-for="spokenLang in user.languages.spokenLang">{{spokenLang}}</li>
                </ul>
                <h2>Learning languages</h2>
                <ul>
                    <li v-for="learningLang in user.languages.learningLang">{{learningLang}}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

import {apiRoot} from '../../config/localhost/settings.js'

export default {
  data() {
    return {
      search: '',
      users: []
    }
  },
  methods: {
    searchUsers: function () {
      this.users = [];
      var formCorrect = 1;
      var regexPseudo = new RegExp(/^([a-zA-Z0-9_-]){1,30}$/);

      if(!regexPseudo.test(this.search)){
        formCorrect = 0;
        console.log("ERROR");
      }


      if(formCorrect != 0){
        this.convertSearchToHTML();

        var _this = this;
        fetch(apiRoot() + 'Controllers/User/researchUser.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
            'Content-Type': 'application/json; charset=utf-8'
          },
          dataType: 'JSON',
          body: JSON.stringify({pseudoToSearch : _this.search})
        }).then(function(response) {
          return response.json();
        }).then(function(data){
          if(data[0] == "Error"){
            //Display error messages
          }
          else {
            _this.users = data["users"];
            console.log(_this.users);
          }
        });
      }
    },
    convertSearchToHTML: function(){
      var text = this.search;
      String.prototype.convertionHTML = function(){
        return this.replace(/[\']/g,"&apos;")
        .replace(/[ ]/g,"&nbsp;")
        .replace(/[\"]/g,"&quot;")
        .replace(/[\«]/g,"&laquot;")
        .replace(/[\»]/g,"&raquot;")
        .replace(/[\']/g,"&apos;")
        .replace(/[\‹]/g,"&lsaquot;")
        .replace(/[\›]/g,"&rsaquot;")
        .replace(/[\...]/g,"&hellip;")
        .replace(/[\¡]/g,"&iexcl;")
        .replace(/[\¿]/g,"&iquest;")
        .replace(/[\ˆ]/g,"&circ;")
        .replace(/[\&]/g,"&amp;")
        .replace(/[\€]/g,"&euro;")
        .replace(/[\¢]/g,"&cent;")
        .replace(/[\£]/g,"&pound;")
        .replace(/[\¥]/g,"&fnof;")
        .replace(/[\<]/g,"&lt;")
        .replace(/[\>]/g,"&gt;")
        .replace(/[\−]/g,"&minus;")
        .replace(/[\×]/g,"&times;")
        .replace(/[\÷]/g,"&divide;")
        .replace(/[\,]/g,"&sbquo;");
      }
      var newSearch = text.convertionHTML();
      this.search = newSearch;
    }
  }
}
</script>

<style lang="scss">
    .searchBar
    { 
        position: relative;
        display: inline-block;
        float: right;
        right: 60px;
        top: 50%;
        transform: translateY(-50%);

        .bar
        {
            width: 300px;
        }

        .result
        {
            z-index: 20;
            border-radius: 3px;
            width: 100%;
            height: auto;
            background-color: red;
            position: absolute;

            .resultitem
            {
                width: 100%;
                height: 50px;
                background-color: green;
            }
        }
    }
</style>
