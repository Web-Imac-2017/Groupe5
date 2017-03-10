<template>

	<div class="admin">

    <div class="row" id="title">
      <div class="col-sm-12">
        ADMINISTRATION
      </div>
    </div>

    <ul>
      <li v-for="user in users">
        <div class="row acceptation">
          <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-4">
                  <img v-bind:src="'/static/avatar/' + user.avatar"> 
                </div>

                <div class="col-lg-8">

                  <div class="name"> {{user.pseudo}} </div>

                  <div class="row">

                    <div class="col-lg-6">
                      <div class = "valid">
                        <icon name="check"></icon>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class = "refuse">
                        <icon name="times"></icon>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </li>
    </ul>

  </div>

</template>

<script>
  import {apiRoot} from '../../config/localhost/settings.js'
  export default {
    data() {
      return {
        users : {
          avatar : '',
          pseudo : ''
        }
      }
    },
    
    methods: {
    getAvatarsNotChecked: function() {
      var _this = this;
      fetch(apiRoot() + 'Controllers/User/getAvatarsNotChecked.php', {
        method: 'POST',
        headers: {
          'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
          'Content-Type': 'application/json; charset=utf-8'
        },
        dataType: 'JSON',
      }).then(function(response) {
        return response.json();
      }).then(function(data){
        if(data[0] == "Error"){
          console.log("ERREUR !!");
        }
        else {
          _this.users = data['users'];
        }
      });
      }
    },
    created : function(){
      this.getAvatarsNotChecked();
    }
  }
</script>

<style lang="scss">

.admin{
  width : 70%;
  margin : auto;
  line-height: 40px;
  text-align: center;
  font-size: 20px;
    
  #title
  {
    margin : 5%;
  }

  .acceptation
  {
    margin: 3%;
    padding: 2%;
    border: 2px solid black;

    .name
    {
      font-weight: 900; 
    }

    img
    {
      width: 100%;
      border: 1px solid black;
    }

    .valid, .refuse 
    {
      margin : 15px;
    }

    .fa-icon
    {
      margin : auto;
      margin : 10%;
      width : 80px;
      height : 80px;
      cursor : pointer;
    }

    .valid .fa-icon:hover{
      color : lightgreen;
    }

    .refuse .fa-icon:hover{
      color : red;
    }
  }
}

</style>
