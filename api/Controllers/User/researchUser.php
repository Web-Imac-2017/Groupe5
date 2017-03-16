<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

$json = json_decode(file_get_contents('php://input'), true);
$pseudo = $json['pseudoToSearch'];
  echo '
    {  
    "users" : [  
        {  
            "pseudo":"AlbaPoire",
            "avatar":"",
            "name":"Poirier",
            "firstname":"Albracca",
            "age":"20",
            "sex":"2",
            "description":"Favorite color    Orange\r\nVehicle    2004 Maserati Coupe ",
            "town":"CLAMART",
            "country":"France",
            "ville":"CLAMART",
            "pays":"France",
            "state":"2",
            "hobbies":[  
                "Video games",
                "Trip",
                "Computering",
                "Fashion"
            ],
            "spokenLang" : [
                {
                    "languageName" : "french",
                    "languageId" : "2"
                },
                {
                    "languageName" : "klingon",
                    "languageId" : "18"
                }
            ],
            "learnedLang" : [
                {
                    "languageName" : "russian",
                    "languageId" : "6"
                },
                {
                    "languageName" : "urdu",
                    "languageId" : "89"
                }
            ]
        },
        {  
            "pseudo":"Fabricetea",
            "avatar":"",
            "name":"Fabrice",
            "firstname":"Teatcher",
            "age":"38",
            "sex":"1",
            "description":"Couleur pr\u00e9f\u00e9r\u00e9e    Vert\n\nV\u00e9hicule    2005 Kia Sedona ",
            "town":"Saint-Pierre",
            "country":"Saint Pierre and Miquelon",
            "ville":"Saint-Pierre",
            "pays":"Saint Pierre and Miquelon",
            "state":"1",
            "hobbies":[  
                "Sport",
                "Politics",
                "Computering",
                "Cooking",
                "Movies",
                "Astronomy",
                "Arts"
            ],
            "languages":[  
                {  
                    "spokenLang":[  
                        {  
                            "id_langue":"6",
                            "name_langue":"Russian"
                        }
                    ]
                },
                {  
                    "learningLang":[  
                        {  
                            "id_langue":"2",
                            "name_langue":"French"
                        },
                        {  
                            "id_langue":"5",
                            "name_langue":"Japanese"
                        },
                        {  
                            "id_langue":"4",
                            "name_langue":"Italian"
                        }
                    ]
                }
            ]
        },
        {  
            "pseudo":"kingofimac",
            "avatar":"",
            "name":"Kalista",
            "firstname":"venceslas",
            "age":"29",
            "sex":"0",
            "description":"The kingof the king of France ! Let\'s learn languages together !",
            "town":"MULHOUSE",
            "country":"France",
            "ville":"MULHOUSE",
            "pays":"France",
            "state":"2",
            "hobbies":[  
                "Cooking",
                "Movies",
                "Politics",
                "Music",
                "Video games"
            ],
            "languages":[  
                {  
                    "spokenLang":[  
                        {  
                            "id_langue":"3",
                            "name_langue":"Spanish"
                        },
                        {  
                            "id_langue":"2",
                            "name_langue":"French"
                        },
                        {  
                            "id_langue":"5",
                            "name_langue":"Japanese"
                        }
                    ]
                },
                {  
                    "learningLang":[  
                        {  
                            "id_langue":"4",
                            "name_langue":"Italian"
                        },
                        {  
                            "id_langue":"6",
                            "name_langue":"Russian"
                        }
                    ]
                }
            ]
        },
        {  
            "pseudo":"PAdu77",
            "avatar":"",
            "name":"M\u00e9rion",
            "firstname":"Pierre-Augustin",
            "age":"24",
            "sex":"2",
            "description":"Couleur pr\u00e9f\u00e9r\u00e9e  Bleu\nV\u00e9hicule   1999 Volvo V70 ",
            "town":"NANCY",
            "country":"France",
            "ville":"NANCY",
            "pays":"France",
            "state":"1",
            "hobbies":[  
                "Movies",
                "Fashion",
                "Video games",
                "Sciences"
            ],
            "languages":[  
                {  
                    "spokenLang":[  
                        {  
                            "id_langue":"1",
                            "name_langue":"English"
                        },
                        {  
                            "id_langue":"5",
                            "name_langue":"Japanese"
                        },
                        {  
                            "id_langue":"4",
                            "name_langue":"Italian"
                        }
                    ]
                },
                {  
                    "learningLang":[  
                        {  
                            "id_langue":"3",
                            "name_langue":"Spanish"
                        }
                    ]
                }
            ]
        },
        {  
            "pseudo":"sapristi",
            "avatar":"",
            "name":"Robtano",
            "firstname":"Benjamin",
            "age":"68",
            "sex":"3",
            "description":"Saperlipopette, sapristipopette !",
            "town":"Navas de Estena",
            "country":"Spain",
            "ville":"Navas de Estena",
            "pays":"Spain",
            "state":"0",
            "hobbies":[  
                "Arts",
                "Music",
                "Fashion",
                "Sciences",
                "Video games"
            ],
            "languages":[  
                {  
                    "spokenLang":[  
                        {  
                            "id_langue":"6",
                            "name_langue":"Russian"
                        }
                    ]
                },
                {  
                    "learningLang":[  
                        {  
                            "id_langue":"5",
                            "name_langue":"Japanese"
                        },
                        {  
                            "id_langue":"3",
                            "name_langue":"Spanish"
                        },
                        {  
                            "id_langue":"4",
                            "name_langue":"Italian"
                        }
                    ]
                }
            ]
        }
    ]
}
  ';


?>
