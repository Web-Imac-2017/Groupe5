<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$pseudo = "";
	$namePays = "";
	$data = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");

		if(isset($_SESSION['login'])) {
            $pseudo = $_SESSION['login'];
        }

	    if(isset($json['nomPays']) && $json['nomPays'] != '') { //A changer en fonction du front !
	    $namePays = $json['nomPays'];
	  }
	  else $data = array("Error", "Error");


	  UserModel::updateUserPays($pseudo, $namePays);

	}
	else $data = array("Error", "Error");

  

  echo json_encode($data);

?>