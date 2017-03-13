<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";
    set_include_path("../../Security/");

    require_once "Crypt/RSA.php";

    $pattern = "#^[a-z0-9]+$#i";

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
            
            if(preg_match($pattern , $pseudo)){
                $data = UserModel::setUserProfil($lastname, $firstname, $pseudo, $email, $password, $avatar, $age, $sex, $city, $color, $date_inscription, $last_connection, $description, $country, $id_etat_activ, $arr_hobbies, $arr_languesSpoken, $arr_languesLearning);
                
                /*Key creation*/
                $rsa = new Crypt_RSA();
                extract($rsa->createKey());
                /*key saving*/
                UserModel::updateUserPublicKey($publickey, $pseudo);
                file_put_contents('../../Security/key/'.$pseudo.'.txt', $privatekey);
            }
            else{
                $data = array("Error", "The pseudo contains special characters or some accent");
            }
        }
        
	}
	else $data = array("Error", "Error: POST2.");

  
  echo json_encode($data);

?>