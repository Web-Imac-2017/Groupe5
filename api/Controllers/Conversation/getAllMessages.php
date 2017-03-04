<?php
    session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/ConversationModel.php";

    $id_conv = "";
    $data = array();

    $_SESSION['id_conv'] = 1;
    $_SESSION['pseudo'] = "kingofimac";
	
    $json = json_decode(file_get_contents('php://input'), true);
    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        $id_conv = $json['conv'];
        $data["messages"] = ConversationModel::getAllMessagesOfConv($id_conv);
        
        $id_user = UserModel::getUserId($_SESSION["pseudo"]);
        
        $data["users"] = ConversationModel::getOtherUsers($id_user, $id_conv);
        
        $data["id"] = $id_conv;
    }
  echo json_encode($data);

?>