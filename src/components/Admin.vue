<template>

	<div class="admin">

    <div class="row" id="title">
      <div class="col-sm-12">
        JE SUIS UNE CASSOS
      </div>
    </div>

    <div class="row acceptation">
      <div class="col-sm-12">

        <div class="row">

            <div class="col-lg-4">
              <div class = "carre"> </div> 
            </div>

            <div class="col-lg-8">

              <div class="name"> NameProfile </div>

              <div class="row">

                <div class="col-lg-6">
                  <div class = "valid">O</div>
                </div>

                <div class="col-lg-6">
                  <div class = "refuse">X</div>
                </div>

              </div>

            </div>

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
      }
    },
  }
</script>

<style lang="scss">

[class*="col-"] {
  background-color: lightgreen;
  border: 2px solid black;
  border-radius: 6px;
  line-height: 40px;
  text-align: center;
}

.admin{
  width : 70%;
  margin : auto;
}

#title
{
  margin : 5%;
}

.acceptation
{
  margin: 3%;
  border: 1px solid black;

  .name
  {
    font-weight: 900; 
  }

  .valid
  {
    margin : auto;
    width : 100px;
    height: 100px;
    border-radius: 2%;
    background-color: green;
  }

  .refuse
  {
    margin : auto;
    width : 100px;
    height: 100px;
    border-radius: 2%;
    background-color: red;
  }

  .valid:hover
  {
    width : 120px;
    height : 120px;
  }

  .refuse:hover
  {
    width : 120px;
    height : 120px;
  }
}

.carre
{
  margin : auto;
  width : 200px;
  height: 200px;
  border-radius: 2%;
  background-color: pink;
}

</style>
