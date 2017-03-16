<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

$json = json_decode(file_get_contents('php://input'), true);
$id = $json['id'];
if($id == 1) {
  echo '
  {
    "messages" : [
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "1",
        "content" : "Je suis une phrase avec un smiley :)"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "2",
        "content" : "Je suis <3 une phrase avec deux smileys :D"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "3",
        "content" : "Je suis <3 une phrase avec trois :/ smileys :D"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "4",
        "content" : "je suis une phrase sans smiley"
      }
    ],
    "users" : [
      {
        "pseudo" : "maureeniz"
      }
    ],
    "ID" : "1"
  }
  ';
}
else{
  echo '
  {
    "messages" : [
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "5",
        "content" : "coucou_:)_Coralie_:)_!!:) :)"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "6",
        "content" : "pas trop :("
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "7",
        "content" : "Pourquoi ?? :P "
      }
    ],
    "users" : [
      {
        "pseudo" : "CoralieBurton"
      }
    ],
    "ID" : "2"
  }
  ';
}


?>
