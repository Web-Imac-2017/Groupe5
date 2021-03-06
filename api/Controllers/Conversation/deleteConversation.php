<?php
session_start();

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

include "../../Models/ConversationModel.php";

$id_conv = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
  $json = json_decode(file_get_contents('php://input'), true);
  if(!is_array($json)) $data = array("Error", "Error: POST.");

  if(isset($json['conv']) && $json['conv'] != ''){
    $id_conv = $json['conv'];
    ConversationModel::deleteConversation($id_conv);
  	$data = array(0);
  }
  else $data = array("Error", "Error: Id conv empty.");
}
else $data = array("Error", "Error: POST.");


echo json_encode($data);

?>