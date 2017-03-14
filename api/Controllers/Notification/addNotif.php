<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/NotificationModel.php";
    include "../../Models/ConversationModel.php";


    $json = json_decode(file_get_contents('php://input'), true);
    $id_notif=$json['id_notif'];
    $emetteur=$json['pseudo1'];
    $recepteur=$json['pseudo2'];
    $pattern = "#^[a-z0-9]+$#i";
    $verif_array = array();


    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if($id_notif==NULL){
            $data = array("Error", "Error: there is no content in the notification.");
        }

        else{
            if(preg_match($pattern , $emetteur) && preg_match($pattern, $recepteur)){
                /*verif si conv existe pas déjà*/
                $verif_array[0] = $emetteur;
                $verif_array[1] = $recepteur;
                
                if($id_notif == "2"){
                    $verif = ConversationModel::ifConvExist($verif_array);
                }else{
                    $verif = 0;
                }
                
                if($verif){
                    $data = array("Error", "Error : A conversation with this user already exists !");
                }else{
                    $data=NotificationModel::addNotif($id_notif,$emetteur,$recepteur);
                }
                
            }
            else{
                $data = array("Error", "Error : Unathorized pseudo");
            }
        }
    }

  echo json_encode($data);

?>