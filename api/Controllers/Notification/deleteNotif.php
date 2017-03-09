<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/NotificationModel.php";


    $json = json_decode(file_get_contents('php://input'), true);
    $id_notif=$json['ID'];



    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if($id_notif==NULL){
            $data = array("Error", "Error: this notification doesn't exist.");
        }

        else{
            $data=NotificationModel::deleteNotif($id_notif);
        }
    }

  echo json_encode($data);

?>