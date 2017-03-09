<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/AdminModel.php";

    $json = json_decode(file_get_contents('php://input'), true);
    $pseudo=$json['pseudo'];


    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        AdminModel::approvePicture($pseudo);
        $data = array("Error", "Il n'y a pas d'erreur");
    }
    

  echo json_encode($data);

?>