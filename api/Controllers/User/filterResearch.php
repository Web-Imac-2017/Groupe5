<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$json = json_decode(file_get_contents('php://input'), true);
	var_dump($json);	

	$data = UserModel::filterResearch($json);

  echo json_encode($data);

?>