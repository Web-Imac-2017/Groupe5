<template lang="html">
    <div class="searchBar">
        <div class="input-group bar">
            <input type="text" class="form-control" placeholder="If u're looking for someone..." v-model="search" id="searchUser">
            <span class="input-group-btn">
                <button v-on:click="searchUsers" id="searchbutton" class="btn btn-default" type="button">Go</button>
            </span>
        </div>
        <div id="resultdiv" class="col-md-12 result">
            <div v-for="user in users" class="col-md-4 resultitem" id="resultitem">
                <div class="resultavatar" id="resultavatar">
                    <img class="resultimg" id="resultimg" :src="'http://www.plume.ink/public_html' + user.avatar" v-on:click="$parent.$parent.changeSelectedUser(user.pseudo)"/>
                </div>
                <div class="resulttext" id="resulttext">
                    <p class="resultuser" id="resultuser">{{ user.pseudo }}</p>
                    <br/>
                    <p class="resultcontent" id="resulcontent">Speaks&nbsp;</p>
                    <ul>
                        <li class="resultcontent" v-for="spoken in user.languages[0].spokenLang">
                            {{ spoken.languageName.name_langue }},&nbsp;
                        </li>
                    </ul>
                    <br/>
                    <p class="resultcontent resultcontent2">Is learning&nbsp;</p>
                    <ul>
                        <li class="resultcontent resultcontent2" v-for="learned in user.languages[1].learningLang">
                            {{ learned.languageName.name_langue }},&nbsp;
                        </li>
                    </ul>
                </div>
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
    searchUsers: function ()
    {
        this.users = [];
        var formCorrect = 1;
        var regexPseudo = new RegExp(/^([a-zA-Z0-9_-]){1,30}$/);

        if (!regexPseudo.test(this.search))
        {
            formCorrect = 0;
            console.log("ERROR");
        }
        if (formCorrect != 0)
        {
            this.convertSearchToHTML();

            var _this = this;
            fetch(apiRoot() + 'Controllers/User/researchUser.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
                    'Content-Type': 'application/json; charset=utf-8'
                },
                dataType: 'JSON',
                body: JSON.stringify({searched : _this.search})
            }).then(function(response) {
                return response.json();
            }).then(function(data){
                if(data[0] == "Error")
                {
                    // Display error messages
                }
                else
                {
                    _this.users = data["users"];
                    console.log(_this.users);
                }
            });
        }
        document.getElementById("resultdiv").style.display = "inline";
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
  },
  created: function() {
    if(this.$parent.$parent.connected != "true") {
      this.$parent.$parent.logout();
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
            width: 500px;
        }

        .result
        {
            z-index: 12;
            border-radius: 3px;
            width: 100%;
            background-color: rgba(100, 100, 100, .5);
            position: absolute;
            margin: 0;
            padding: 5px;
            display: none;

            .resultitem
            {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100px;
                background-color: green;
                margin-bottom: 5px;
                cursor: pointer;

                &:hover .resulttext
                {
                    background-color: #A1D4E2;
                }

                &:last-child
                {
                    margin-bottom: 0px;
                }

                .resultavatar
                {
                    height: 100%;
                    width: 100px;
                    display: inline-block;

                    .resultimg
                    {
                        height: 100%;
                        width: 100%;
                    }
                }

                .resulttext
                {
                    display: inline-block;
                    height: 100%;
                    width: calc(100% - 100px);
                    background-color: #CFDEE7;
                    float: right;
                    transition: .2s;

                    .resultuser
                    {
                        text-transform: uppercase;
                        letter-spacing: 2px;
                        font-weight: 700;
                        font-size: 1.8em;
                    }

                    & > p
                    {
                        margin: 0;
                        margin-left: 10px;
                        margin-top: 3px; 
                        display: inline-block;
                    }

                    .resultcontent
                    {
                        margin-top: 0;
                        font-size: 1.2em;
                        display: inline-block;
                        float: left;
                    }

                    .resultcontent2
                    {
                        margin-top: -8px;
                    }

                    .resultspoken
                    {
                        font-size: 1.5em;
                        display: inline-block
                    }
                }
            }
        }
    }

    .visible
    {
        display: inline;
    }

    .invisible
    {
        display: none;
    }
</style>
