<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/AdminModel.php";

    $json = json_decode(file_get_contents('php://input'), true);
    $username=$json['username'];
    $password=$json['password'];
    $data = "false";

    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        $data = AdminModel::checkUsernamePassword($username, $password);
    }
    
    echo json_encode($data);

?>