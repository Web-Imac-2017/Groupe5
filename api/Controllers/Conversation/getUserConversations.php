<?php
	session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/ConversationModel.php";
	
	$data = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");
		else {
			if(isset($json['pseudo']) && $json['pseudo'] != '') {
				$pseudo = $json['pseudo'];

				$data["conversations"] = ConversationModel::getConvOfUser($pseudo);

			}
			else {
				$data = array("Error", "Error: Pseudo");
			}
		}
	}
	else $data = array("Error", "Error: Post");

	echo json_encode($data);

?>
