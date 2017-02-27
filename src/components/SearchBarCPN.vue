<template lang="html">
  <div class="col-md-offset-6 col-md-4">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search a Plummate">
      <span class="input-group-btn">
        <button v-on:click="search" class="btn btn-default" type="button">Go</button>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    search: function () {
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/search.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
        body: JSON.stringify({pseudo : this.pseudo})
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          //Display error messages
        }
        else {
          //_this.$router.push('/Profil/' + data['pseudo']);
        }
      });
    }
  }
}
</script>

<style lang="scss">
</style>
