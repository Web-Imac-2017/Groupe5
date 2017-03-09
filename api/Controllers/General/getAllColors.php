<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

echo '{
    "colors" : [
        {
            "name" : "lemon",
            "normal" : "#FFE74C",
            "light" : "#FFE79C"
        },
        {
            "name" : "strawberry",
            "normal" : "#FF5964",
            "light" : "#FF8DA0"
        },
        {
            "name" : "sky",
            "normal" : "#35A7FF",
            "light" : "#89D4FF"
        },
        {
            "name" : "blueberry",
            "normal" : "#9881F5",
            "light" : "#C1B1F5"
        },
        {
            "name" : "sea",
            "normal" : "#60C5BA",
            "light" : "#99C5BE"
        },
        {
            "name" : "summer",
            "normal" : "#6ABE83",
            "light" : "#94BEA5"
        },
        {
            "name" : "fire",
            "normal" : "#E62739",
            "light" : "#E68194"
        },
        {
            "name" : "orange",
            "normal" : "#F68B1F",
            "light" : "#F6BC7E"
        },
        {
            "name" : "night",
            "normal" : "#003366",
            "light" : "#A4C4FF"
        },
        {
            "name" : "steel",
            "normal" : "#888888",
            "light" : "#CCCCCC"
        }
    ]
}';

?>
