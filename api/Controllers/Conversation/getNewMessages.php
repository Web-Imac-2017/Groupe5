<?php
session_start();

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');

include "../../Models/ConversationModel.php";

$last_message = $_SESSION['last_message'];
$id_conv = $_SESSION['conv'];

$data["messages"] = ConversationModel::getNewMessagesOfConv($last_message, $id_conv);
$_SESSION['last_message'] = $data["messages"][0]["ID"];

/*var_dump($_SESSION['last_message']);*/

echo json_encode($data);

?>