<template lang="html">
  <div class="searchBar">
    <div class="col-md-4">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search a Plummate" v-model="search">
        <span class="input-group-btn">
          <button v-on:click="searchUsers" class="btn btn-default" type="button">Go</button>
        </span>
      </div>
    </div>
    <div class="col-md-12">
      <div v-for="user in users" class="col-md-4">
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
      users: ''
    }
  },
  methods: {
    searchUsers: function () {
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/searchUser.php', {
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
        }
      });
    }
  }
}
</script>

<style lang="scss">
</style>
