<?php
    session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/ConversationModel.php";

    $id_conv = "";
    $data = array();

    //$_SESSION['id_conv'] = 1;
    $_SESSION['login'] = "kingofimac";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){    
        $json = json_decode(file_get_contents('php://input'), true);
        
        if(!is_array($json)){
            $data = array("Error", "Error: no data received.");
            
        }else{
            if(isset($json['id']) && $json['id'] != ''){
                $id_conv = $json['id'];
                $_SESSION['conv'] = $id_conv;
                
                $data["messages"] = ConversationModel::getAllMessagesOfConv($id_conv);
        
                $id_user = UserModel::getUserId($_SESSION["login"]);

                $data["users"] = ConversationModel::getOtherUsers($id_user, $id_conv);
                $current_user = array();
                $current_user["pseudo"] = $_SESSION["login"];
                array_push($data["users"], $current_user);

                $data["id"] = $id_conv;
                
                $_SESSION['last_message'] = $data['messages'][0]["ID"];
                
            }else{
                $data = array("Error", "Error: the conversation id doesn't exist.");
            }
        }
    }else{
        $data = array("Error", "Error: POST.");
    }

  echo json_encode($data);

?>