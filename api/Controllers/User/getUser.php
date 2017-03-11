<?php 
    session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

    $data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {   
        $json = json_decode(file_get_contents('php://input'), true);
        if(!is_array($json)) $data = array("Error", "Error: POST.");
        $pseudo = $json['pseudo'];

        $data["pseudo"] = $pseudo;
        $data["avatar"] = UserModel::getUserAvatar($pseudo);
        $data["lastname"] = UserModel::getUserLastName($pseudo);
        $data["age"] = UserModel::getUserAge($pseudo);
        $data["sex"] = UserModel::getUserSex($pseudo);
        $data["firstname"] = UserModel::getUserName($pseudo);
        $data["description"] = UserModel::getUserDescription($pseudo);
        $data["city"] = UserModel::getUserCity($pseudo);
        $data["color"] = UserModel::getUserColor($pseudo);
        $data["country"] = UserModel::getUserPays($pseudo);
        $data["hobbies"] = UserModel::getUserHobbies($pseudo);
        $data["languages"]["spokenLang"] = UserModel::getUserLangueMaitrisee($pseudo);
        $data["languages"]["learningLang"] = UserModel::getUserLangueAApprendre($pseudo);
    }
    else $data = array("Error", "Error: POST.");

    echo json_encode($data);

?>
