<?php 
	session_start();
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";

	$pseudo = "";
	$nameLang = "";
	$niveauLang = "";
	$data = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");

		if(isset($_SESSION['login'])) {
            $pseudo = $_SESSION['login'];
        }

	    if(isset($json['NomLang']) && $json['NomLang'] != '') { //A modifier avec le front !
	    $nameLang = $json['NomLang'];

	    if(isset($json['NivLang']) && $json['NivLang'] != '') { //A modifier avec le front ! Correspond à maîtriser ou à apprendre
	    $nivLang = $json['NivLang'];
	  }
	  else $data = array("Error", "Error");


	  UserModel::setUserLang($pseudo, $nameLang, $nivLang);

	}
	else $data = array("Error", "Error");

  

  echo json_encode($data);

?>