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
        "content" : "Hello comment ça va"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "2",
        "content" : "Jai une grand nouvelle à tannoncer : Nullam ultrices, eros vitae vulputate congue, arcu ex posuere lacus, ac viverra odio lectus scelerisque urna. Proin pellentesque mi ante, a cursus est eleifend vel. Sed bibendum, felis et blandit bibendum, urna nisl tempus enim, at maximus neque justo quis dolor. Fusce vel quam eu leo gravida tristique. Maecenas eget dapibus leo"
      },
      {
        "user" : "maureeniz",
        "date" : "23/05/2017",
        "ID" : "3",
        "content" : " Quisque iaculis diam vel risus euismod tincidunt. Sed rutrum lectus eleifend nibh malesuada venenatis. Vestibulum vitae augue tincidunt, consequat metus in, sagittis ex. Aliquam erat volutpat. Nam tempus leo ID :D iaculis sagittis."
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
        "content" : "Hello comment ça va"
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "2",
        "content" : "Jai une grand nouvelle à tannoncer : Nullam ultrices, eros vitae vulputate congue, arcu ex posuere lacus, ac viverra odio lectus scelerisque urna. Proin pellentesque mi ante, a cursus est eleifend vel. Sed bibendum, felis et blandit bibendum, urna nisl tempus enim, at maximus neque justo quis dolor. Fusce vel quam eu leo gravida tristique. Maecenas eget dapibus leo"
      },
      {
        "user" : "maureeniz",
        "date" : "23/05/2017",
        "ID" : "3",
        "content" : " Quisque iaculis diam vel risus euismod tincidunt. Sed rutrum lectus eleifend nibh malesuada venenatis. Vestibulum vitae augue tincidunt, consequat metus in, sagittis ex. Aliquam erat volutpat. Nam tempus leo ID iaculis sagittis."
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "4",
        "content" : "Proin sit amet libero dolor. Morbi augue risus, placerat ut erat ac, commodo pellentesque dolor. Morbi dapibus ipsum nunc, rhoncus egestas tortor dictum nec. Vivamus pharetra sit amet odio quis hendrerit. Etiam venenatis eros nec aliquam ornare. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis leo quis justo porttitor bibendum. Nullam sodales sit amet mauris et euismod. Ut rutrum molestie lacus non rhoncus. Duis nec lacus tincidunt metus venenatis aliquam. Nunc ID arcu eget elit gravida sollicitudin eu vitae ex."
      },
      {
        "user" : "CoralieBurton",
        "date" : "23/05/2017",
        "ID" : "5",
        "content" : "Je suis une petit bulle toute mignonne :)"
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
