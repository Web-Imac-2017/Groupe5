<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

echo '{
    "countries" : [
        {
            "name" : "France"
        },
        {
            "name" : "Germany"
        },
        {
            "name" : "Englanc"
        },
        {
            "name" : "Spain"
        }
    ]
}';

?>
