<?php 
	session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$pseudo = "";
	$namePays = "";
	$data = "";

	/*if ($_SERVER['REQUEST_METHOD'] == 'POST'){	

		$json = json_decode(file_get_contents('php://input'), true);
		print_r(file_get_contents('php://input'));
		if(!is_array($json)) $data = array("Error", "Error: Post");

		if(isset($json['pseudo'])) {
      $pseudo = $json['pseudo'];
      $role = $json['role'];

      $data = UserModel::getUserMatch($pseudo, $role);

      //var_dump($data['langue']['users']);


      //$data = UserModel::ClasseUserMatch($data['langue']);
    }

	 }
	 else $data = array("Error", "Error");

	 //$data = UserModel::getUserMatch("Robibidu77","2");

  echo json_encode($data, JSON_PRETTY_PRINT);*/

  	echo '[{
    "id_langue": "1",
    "name_langue": "English",
    "users": [{
        "id_user": "5",
        "nbCommuns": 1,
        "id_interet": ["2"],
        "infos": {
            "pseudo": "kingofimac",
            "avatar": "",
            "name": "Kalista",
            "firstname": "venceslas",
            "age": "29",
            "sex": "0",
            "description": "kingofimac description",
            "town": "Ville test kingofimac",
            "country": "France",
            "ville": "Ville test kingofimac",
            "pays": "France",
            "state": "2",
            "hobbies": ["Cooking", "Movies"],
            "languages": [{
                "spokenLang": [{
                    "id_langue": "3",
                    "name_langue": "Spanish"
                }]
            }, {
                "learningLang": [{
                    "id_langue": "1",
                    "name_langue": "English"
                }]
            }]
        }
    }]
}, {
    "id_langue": "5",
    "name_langue": "Japanese",
    "users": [{
        "id_user": "3",
        "nbCommuns": 2,
        "id_interet": ["10", "9"],
        "infos": {
            "pseudo": "sapristi",
            "avatar": "",
            "name": "Robtano",
            "firstname": "Benjamin",
            "age": "68",
            "sex": "3",
            "description": "sapristi descrption",
            "town": "ville test sapristi",
            "country": "Spain",
            "ville": "ville test sapristi",
            "pays": "Spain",
            "state": "0",
            "hobbies": ["Arts", "Music", "Fashion", "Sciences", "Video games"],
            "languages": [{
                "spokenLang": []
            }, {
                "learningLang": [{
                    "id_langue": "5",
                    "name_langue": "Japanese"
                }, {
                    "id_langue": "3",
                    "name_langue": "Spanish"
                }, {
                    "id_langue": "4",
                    "name_langue": "Italian"
                }]
            }]
        }
    }]
}]';



?>