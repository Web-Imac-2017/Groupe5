<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$json = json_decode(file_get_contents('php://input'), true);
	$searched=$json['searched'];

	$pattern = "#^[a-z0-9]+$#i";
	if (preg_match($pattern , $searched)){
		$pseudo = UserModel::userResearch($searched);

		$data = array();
		$data['users'] = array();

		foreach ($pseudo as $key => $user) {
			array_push($data['users'], UserModel::getUser($user['pseudo']));
		}
	}
	else{
		$data=array("Error", "Error : You're research is unauthorized");
	}
	

  echo json_encode($data);

?>