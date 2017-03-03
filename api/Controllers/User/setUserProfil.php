<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

    $lastname = "";
    $firstname = "";
    $pseudo = "";
    $email = "";
    $password = "";
    $avatar = "";
    $age = "";
    $sex = "";
    $city = "";
    $color = "";
    $date_inscription = "";
    $last_connection = "";
    $description = "";
    $country = "";
    $id_etat_activ = "";
    $arr_hobbies;
    $arr_languesSpoken;
    $arr_languesLearning;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: POST1.");
        else {
            print_r($json);

            $lastname = $json['lastname'];
            $firstname = $json['firstname'];
            $pseudo = $json['pseudo'];
            $email = $json['email'];
            $password = $json['password'];
            $avatar = $json['avatar'];
            $age = $json['age'];
            $sex = $json['sex'];
            $city = $json['city'];
            $color = $json['color'];
            $date_inscription = date("Y-m-d");
            $last_connection = date("Y-m-d");
            $description = $json['description'];
            $country = $json['country'];
            $id_etat_activ = 1;
            $arr_hobbies = $json['hobbies'];
            $arr_languesSpoken = $json['languages']['spokenLang'];
            $arr_languesLearning = $json['languages']['learningLang'];
            
            $data = UserModel::setUserProfil($lastname, $firstname, $pseudo, $email, $password, $avatar, $age, $sex, $city, $color, $date_inscription, $last_connection, $description, $country, $id_etat_activ, $arr_hobbies, $arr_languesSpoken, $arr_languesLearning);
        }
        
	}
	else $data = array("Error", "Error: POST2.");

  
  echo json_encode($data);

?>