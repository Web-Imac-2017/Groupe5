<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

echo '{
    "conversations" : [
        {
            "users" : [
                {
                    "pseudo" : "Maureen"
                }
            ],
            "lastMessage" : "Lorem Ipsum",
            "id" : "1"
        },
        {
            "users" : [
                {
                    "pseudo" : "Tim Burton"
                }
            ],
            "lastMessage" : "Lorem Ipsum2",
            "id" : "2"
        },
        {
            "users" : [
                {
                    "pseudo" : "Hellowizz"
                }
            ],
            "lastMessage" : "Lorem Ipsum3",
            "id" : "3"
        },
        {
            "users" : [
                {
                    "pseudo" : "Mister Jack"
                }
            ],
            "lastMessage" : "Lorem Ipsum4",
            "id" : "4"
        },
        {
            "users" : [
                {
                    "pseudo" : "JadeLeMeilleurChienDuMonde"
                }
            ],
            "lastMessage" : "Lorem Ipsum5",
            "id" : "5"
        },
        {
            "users" : [
                {
                    "pseudo" : "ViveLesFelins"
                }
            ],
            "lastMessage" : "Lorem Ipsum6",
            "id" : "6"
        },
        {
            "users" : [
                {
                    "pseudo" : "LoremIpsum"
                }
            ],
            "lastMessage" : "Lorem Ipsum7",
            "id" : "7"
        }

    ]
}';

?>
