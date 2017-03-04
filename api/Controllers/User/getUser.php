<?php 
    session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

    $data = array();

    $json = json_decode(file_get_contents('php://input'), true);
    $pseudo = $json['pseudo'];

    $data["pseudo"] = $pseudo;
    $data["avatar"] = "";
    $data["name"] = UserModel::getUserLastName($pseudo);
    $data["age"] = UserModel::getUserAge($pseudo);
    $data["sexe"] = UserModel::getUserSex($pseudo);
    $data["prenom"] = UserModel::getUserName($pseudo);
    $data["description"] = UserModel::getUserDescription($pseudo);
    $data["ville"] = UserModel::getUserCity($pseudo);
    $data["pays"] = UserModel::getUserPays($pseudo);
    $data["hobbies"] = UserModel::getUserHobbies($pseudo);
    $data["languages"]["spokenLang"] = UserModel::getUserLangueMaitrisee($pseudo);
    $data["languages"]["learningLang"] = UserModel::getUserLangueAApprendre($pseudo);

    echo json_encode($data);

?>
