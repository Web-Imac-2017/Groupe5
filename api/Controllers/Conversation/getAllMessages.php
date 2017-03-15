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
        "content" : "Ca me saoule ! :@"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "1",
        "content" : "dis moi tout :/"
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
        "ID" : "1",
        "content" : "Hello comment ça va ? :)"
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
