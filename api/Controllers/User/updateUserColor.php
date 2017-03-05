<?php 
	session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$pseudo = "";
	$userColor = "";
	$data = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");

		if(isset($json['pseudo'])) {
            $pseudo = $json['pseudo'];
        }

	    if(isset($json['couleur']) && $json['couleur'] != '') { /*A voir avec le front*/
	    $userColor = $json['couleur'];
	  }
	  else $data = array("Error", "Error");


	  UserModel::updateUserColor($pseudo, $userColor);

	}
	else $data = array("Error", "Error");

  

  echo json_encode($data);

?>