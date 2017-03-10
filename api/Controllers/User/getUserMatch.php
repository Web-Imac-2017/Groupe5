<?php 
	session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
		$json = json_decode(file_get_contents('php://input'), true);
		if((isset($json['pseudo']))&&(isset($json['role']))){
      $pseudo = $json['pseudo'];
      $role = $json['role'];

      $sex = NULL;
      $minAge = NULL;
      $maxAge = NULL;

      if(isset($json['sex'])){
      	$sex = $json['sex'];
      }

      if(isset($json['minAge'])){
      	$minAge = $json['minAge'];
      }

      if(isset($json['maxAge'])){
      	$minAge = $json['maxAge'];
      }

      $data = UserModel::getUserMatch($pseudo, $role, $sex, $minAge, $maxAge);
    }
    else $data = array("Error", "Error: pseudo or role not defined");
	 }
	 else $data = array("Error", "Error: POST.");
  echo json_encode($data);


?>