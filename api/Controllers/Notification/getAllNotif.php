<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/NotificationModel.php";

    $id_user = "";
    $data = array();

    $json = json_decode(file_get_contents('php://input'), true);
    $pseudo=$json['pseudo'];
    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if(isset($json['id']) && $json['id'] != ''){
            $id_notif = $json['id'];
            $data=NotificationModel::getAllNotif($id_user);

        }
        else{
            $data = array("Error", "Error: there is no notification.");
        }
    }

  echo json_encode($data);

?>