<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/NotificationModel.php";


    $json = json_decode(file_get_contents('php://input'), true);
    $pseudo=$json['pseudo'];
    $pattern = "#^[a-z0-9]+$#i";

    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if($pseudo==NULL){
            $data = array("Error", "Error: there is no notification.");
        }

        else{
            if(preg_match($pattern , $pseudo)){
                $data=NotificationModel::getAllNotif($pseudo);
            }
            else{
                $data = array("Error", "Error : Unathorized pseudo");
            }
        }
    }

  echo json_encode($data);

?>