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
    "avatar": "maureeniz.jpg",
    "firstname": "Maureen",
    "lastname": "Roche",
    "age": "21",
    "country": "France",
    "city": "bordeaux",
    "description": "Hi :D. If you\'re looking for a funny french girl to talk to, here I stand !",
    "hobbies" : ["travel", "music", "cinema", "science","arts"],
    "languages" : {
      "spokenLang" : ["french", "english"],
      "learningLang" : ["spanish", "chinese", "german"]
    }
  }
  ';
}
else {
  echo '
  {
    "pseudo": "CoralieBurton",
    "avatar": "maureeniz.jpg",
    "firstname": "Coralie",
    "lastname": "Goldbaum",
    "age": "21",
    "country": "France",
    "city": "Paris",
    "description": "I loooove dogs and Tim Burton!",
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
