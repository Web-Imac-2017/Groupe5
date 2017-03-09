<?php
session_start();

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

include "../../Models/ConversationModel.php";

$pseudo_array = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
  $json = json_decode(file_get_contents('php://input'), true);
  if(!is_array($json)) $data = array("Error", "Error: POST.");
    
    $json['pseudo_conv'] = array('Fabricetea', 'kingofimac');

  if(isset($json['pseudo_conv']) && $json['pseudo_conv'] != ''){
    $pseudo_array = $json['pseudo_conv'];
    ConversationModel::createConv($pseudo_array);
  	$data = array(0);
  }
  else $data = array("Error", "Error: Message empty.");
}
else $data = array("Error", "Error: POST.");


echo json_encode($data);

?>