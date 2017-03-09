<?php
    session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/ConversationModel.php";

    $id_conv = "";
    $data = array();

    $json = json_decode(file_get_contents('php://input'), true);
    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if(isset($json['id']) && $json['id'] != ''){
            $id_conv = $json['id'];
            $data["messages"] = ConversationModel::getAllMessagesOfConv($id_conv);

            $id_user = UserModel::getUserId($json['pseudo']);

            $data["users"] = ConversationModel::getOtherUsers($id_user, $id_conv);
            $current_user = array();
            $current_user["pseudo"] = $json['pseudo'];
            array_push($data["users"], $current_user);

            $data["id"] = $id_conv;    
        }
        else{
            $data = array("Error", "Error: the conversation id doesn't exist.");
        }
    }

  echo json_encode($data);

?>