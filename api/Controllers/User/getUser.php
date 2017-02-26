<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');


echo '{
  "users" : [
    {
      "pseudo": "maureeniz",
      "avatar": "maureeniz.jpg",
      "name": "maureen roche",
      "age": "21",
      "country": "France",
      "city": "bordeaux",
      "description": "Hi :D. If you\'re looking for a funny french girl to talk to, here I stand !",
      "hobbies" : ["travel", "music", "cinema", "science","arts"],
      "languages" : {
        "spokenLang" : "french", "english"],
        "learningLang" : "spanish", "chinese", "german"]
      }
    }
  ]
}';

?>
