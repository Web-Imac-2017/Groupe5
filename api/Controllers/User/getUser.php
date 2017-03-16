<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

$json = json_decode(file_get_contents('php://input'), true);
$pseudo = $json['pseudo'];

if($pseudo == "maureeniz") {
  echo '
  {
    "pseudo": "maureeniz",
    "avatar": "/static/avatar/maureeniz.jpg",
    "firstname": "Maureen",
    "lastname": "Roche",
    "age": "21",
    "country": "France",
    "city": "bordeaux",
    "description": "Hi :D. If you\'re looking for a funny french girl to talk to, here I stand !",
    "hobbies" : ["Travel", "Music", "Cinema", "Sciences","Arts"],
    "languages" : {
      "spokenLang" : ["french", "english"],
      "learningLang" : ["spanish", "chinese", "german"]
    },
    "color": "#6A91C9"
  }
  ';
}
else {
  echo '
  {
    "pseudo": "KORALAI",
    "avatar": "maureeniz.jpg",
    "firstname": "Coralie",
    "lastname": "Goldbaum",
    "age": "21",
    "country": "France",
    "city": "Paris",
    "description": "Hello, how are you ? I am getting better since I ate ice cream. I love dogs and I live on the Moon with several purple flying guys. I like to excange with people, don\'t wait to come talking with me :D",
    "hobbies" : ["Music", "Cinema"],
    "languages" : {
      "spokenLang" : ["French", "English"],
      "learningLang" : ["Spanish", "German"]
    },
    "color": "blue"
  }
  ';
}


?>
