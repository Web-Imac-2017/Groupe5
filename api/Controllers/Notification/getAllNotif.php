<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

echo '[
    {
        "ID" : "5",
        "ID_user1" : "3",
        "date" : "2017-03-06 00:00:00",
        "content" : "would like to talk with you",
        "user" : "Aleqsandr"
    }
]';

?>
