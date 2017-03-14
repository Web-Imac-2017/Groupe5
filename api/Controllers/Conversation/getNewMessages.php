<?php
    session_start();

    header('Access-Control-Allow-Origin:*');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header('Content-Type: application/json;charset=utf-8');

    include "../../Models/ConversationModel.php";

    $last_message = "";
    $id_conv = "";

    $json = json_decode(file_get_contents('php://input'), true);
    if(!is_array($json)) $data = array("Error", "Error: POST.");
    else {
        if(isset($json['last_message']) && $json['last_message'] != ''
          && isset($json['conv']) && $json['conv'] != ''){
            
            $last_message = $json['last_message'];
            $id_conv = $json['conv'];

            $data["messages"] = ConversationModel::getNewMessagesOfConv($last_message, $id_conv);
            if(!empty($data["messages"])){
                $last = count($data["messages"])-1;
                $data["last_message"] = $data[$last]['ID']; 
            }

         }
        else{
            $data = array("Error", "Error: no data received.");
        }
    }


    echo json_encode($data);

?>