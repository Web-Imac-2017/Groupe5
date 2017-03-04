<?php
	session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/ConversationModel.php";

	$pseudo = $_SESSION['login'];

	//$pseudo = "kingofimac";

	$result_conv = [];

	/*all conv*/
	$result_conv["conversations"] = ConversationModel::getConvOfUser($pseudo);

	echo json_encode($result_conv);

?>
