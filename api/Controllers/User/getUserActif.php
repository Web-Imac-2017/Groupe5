<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	echo ' 
  

{
  "userActif" : {
        "pseudo": "MyPseudo",
        "avatar": "maureeniz.jpg",
        "lastname": "roche",
        "firstname": "maureen",
        "age": "21",
        "country": "France",
        "city": "bordeaux",
        "description": "Hi :D. If you&#39re looking for a funny french girl to talk to, here I stand !",
        "color": "#4E55F3",
        "hobbies" : ["travel", "music", "cinema", "science","arts"],
        "spokenLang" : ["french", "english"],
          "learningLang" : ["spanish", "chinese", "german"]
        
      }
}


';

?>