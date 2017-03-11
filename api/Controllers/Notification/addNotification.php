<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/NotificationModel.php";


    $json = json_decode(file_get_contents('php://input'), true);
    $contenu=$json['contenu'];
    $emetteur=$json['pseudo1'];
    $recepteur=$json['pseudo2'];

    $data = [];

    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if($contenu==NULL){
            $data = array("Error", "Error: there is no content in the notification.");
        }

        else{
            NotificationModel::addNotification($contenu,$emetteur,$recepteur);
        }
    }

  echo json_encode($data);

?>