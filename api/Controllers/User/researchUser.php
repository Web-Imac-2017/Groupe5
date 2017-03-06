<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

$json = json_decode(file_get_contents('php://input'), true);
$pseudo = $json['pseudoToSearch'];
  echo '
    {
    "users": [
      {
        "pseudo": "maureeniz",
        "avatar": "maureeniz.jpg",
        "name": "maureen roche",
        "age": "21",
        "country": "France",
        "city": "bordeaux",
        "description": "Hi :D. If youre looking for a funny french girl to talk to, here I stand !",
        "hobbies" : ["travel", "music", "cinema", "science","arts"],
        "languages" : {
          "spokenLang" : ["french", "english"],
          "learningLang" : ["spanish", "chinese", "german"]
        }
      },
      {
        "pseudo": "Hellowizz",
        "avatar": "maureeniz.jpg",
        "name": "maureen roche",
        "age": "21",
        "country": "France",
        "city": "Paris",
        "description": "Hi :D. If youre looking for a funny french girl to talk to, here I stand !",
        "hobbies" : ["travel", "music", "cinema", "science","arts"],
        "languages" : {
          "spokenLang" : ["french", "english"],
          "learningLang" : ["spanish", "chinese", "german"]
        }
      },
      {
        "pseudo": "Coralie",
        "avatar": "maureeniz.jpg",
        "name": "maureen roche",
        "age": "21",
        "country": "France",
        "city": "Paris",
        "description": "Hi :D. If youre looking for a funny french girl to talk to, here I stand !",
        "hobbies" : ["travel", "music", "cinema", "science","arts"],
        "languages" : {
          "spokenLang" : ["french", "english"],
          "learningLang" : ["spanish", "chinese", "german"]
        }
      },
      {
        "pseudo": "Alex",
        "avatar": "maureeniz.jpg",
        "name": "maureen roche",
        "age": "21",
        "country": "France",
        "city": "Noisy-Le-Grand",
        "description": "Hi :D. If youre looking for a funny french girl to talk to, here I stand !",
        "hobbies" : ["travel", "music", "cinema", "science","arts"],
        "languages" : {
          "spokenLang" : ["french", "english"],
          "learningLang" : ["spanish", "chinese", "german"]
        }
      }
    ]
  }
  ';


?>
