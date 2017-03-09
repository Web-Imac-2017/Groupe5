<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

echo '{
    "users" : [
        {"avatar": "aleqsandr.jpg", "pseudo" : "Aleqsandr"},
        {"avatar": "coralie.jpg", "pseudo" : "Coralie"},
        {"avatar": "hellowizz.jpg", "pseudo" : "Hellowizz"},
        {"avatar": "maureeniz.jpg", "pseudo" : "Maureeniz"}
    ]
}';

?>