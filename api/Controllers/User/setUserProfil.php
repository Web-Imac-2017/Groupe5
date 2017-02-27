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
    $date_inscription = "";
    $last_connection = "";
    $description = "";
    $pays = "";
    $id_etat_activ = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: POST.");

		if(isset($json['nom']) && $json['nom'] != '' && isset($json['prenom']) && $json['prenom'] != ''
          && isset($json['pseudo']) && $json['pseudo'] != '' && isset($json['email']) && $json['email'] != ''
          && isset($json['password']) && $json['password'] != '' && isset($json['date_inscription']) && $json['date_inscription'] != ''
          && isset($json['description']) && $json['description'] != '' && isset($json['pays']) && $json['pays'] != '') {
            
            $nom = $json['nom'];
            $prenom = $json['prenom'];
            $pseudo = $json['pseudo'];
            $email = $json['email'];
            $password = $json['password'];
            $date_inscription = date("Y-M-d H:i:s");
            $last_connection = date("Y-M-d H:i:s");
            $description = $json['description'];
            $pays = $json['pays'];
            $id_etat_activ = 1;

	  }
	  else $data = array("Error", "Error: One var empty.");

	  $data = UserModel::setUserProfil($nom, $prenom, $pseudo, $email, $password, $date_inscription, $last_connection, $description, $pays, $id_etat_activ);
        
	}
	else $data = array("Error", "Error: POST.");

  
  echo json_encode($data);

?>