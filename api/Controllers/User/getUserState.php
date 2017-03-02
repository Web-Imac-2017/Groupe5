<?php 
	session_start();
	
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	if(isset($_SESSION['login'])) {
		$data = UserModel::getUserState($_SESSION['login']);
	}
	else {
		$data = [0];
	}


  echo json_encode($data);

?>