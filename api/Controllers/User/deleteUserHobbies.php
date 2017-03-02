<?php 
	session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$pseudo = "";
	$nameHobby = "";
	$data = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");

		if(isset($_SESSION['login'])) {
            $pseudo = $_SESSION['login'];
        }

	    if(isset($json['NomInteret']) && $json['NomInteret'] != '') { //A modifier avec le front !
	    $nameHobby = $json['NomInteret'];
	  }
	  else $data = array("Error", "Error");


	  UserModel::deleteUserHobbies($pseudo, $nameHobby);

	}
	else $data = array("Error", "Error");

  

  echo json_encode($data);

?>