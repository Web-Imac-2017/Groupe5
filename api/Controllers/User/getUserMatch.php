<?php 
	session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	//header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$pseudo = "";
	$namePays = "";
	$data = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){	

		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");

		if(isset($json['pseudo'])) {
            $pseudo = $json['pseudo'];

            $data = UserModel::getUserMatch($pseudo);
        }

	 }
	 else $data = array("Error", "Error");

	 $data = UserModel::getUserMatch("PAdu77", 2, NULL, NULL, NULL);
	 
	 var_dump($data);



  echo json_encode($data);

?>