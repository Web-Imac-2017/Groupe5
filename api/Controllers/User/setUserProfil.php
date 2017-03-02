<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

    $nom = "";
    $prenom = "";
    $pseudo = "";
    $email = "";
    $password = "";
    $avatar = "";
    $age = "";
    $sexe = "";
    $ville = "";
    $couleur = "";
    $date_inscription = "";
    $last_connection = "";
    $description = "";
    $pays = "";
    $id_etat_activ = "";
    $arr_hobbies = array();
    $arr_langues = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: POST.");

		if(isset($json['nom']) && $json['nom'] != '' && isset($json['prenom']) && $json['prenom'] != ''
          && isset($json['pseudo']) && $json['pseudo'] != '' && isset($json['email']) && $json['email'] != ''
          && isset($json['password']) && $json['password'] != '' && isset($json['age']) && $json['age'] != '' 
           && isset($json['date_inscription']) && $json['date_inscription'] != ''&& isset($json['pays']) && $json['pays'] != '') {
            
            $nom = $json['nom'];
            $prenom = $json['prenom'];
            $pseudo = $json['pseudo'];
            $email = $json['email'];
            $password = $json['password'];
            $avatar = $json['avatar'];
            $age = $json['age'];
            $sexe = $json['sexe'];
            $ville = $json['ville'];
            $couleur = $json['couleur'];
            $date_inscription = date("Y-M-d H:i:s");
            $last_connection = date("Y-M-d H:i:s");
            $description = $json['description'];
            $pays = $json['pays'];
            $id_etat_activ = 1;
            $arr_hobbies = $json['hobbies'];
            $arr_langues = $json['languages'];
            
	  }
	  else $data = array("Error", "Error: One var empty.");

	  $data = UserModel::setUserProfil($nom, $prenom, $pseudo, $email, $password, $avatar, $age, $sexe, $ville, $couleur, $date_inscription, $last_connection, $description, $pays, $id_etat_activ, $arr_hobbies, $arr_langues);
        
	}
	else $data = array("Error", "Error: POST.");

  
  echo json_encode($data);

?>