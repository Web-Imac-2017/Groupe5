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
		else {
			if(isset($json['pseudo'])) {
       $pseudo = $json['pseudo'];
      }

      if(isset($json['level']) && $json['level'] != '') {
      	$level = $json['level'];
      	$oldLanguages = array();

	      if($level == 1) {
	      	$oldLanguages = UserModel::getUserLangueAApprendre($pseudo);
	      	foreach ($oldLanguages['learningLang'] as $key => $language) {
					  UserModel::deleteUserLang($pseudo, $language);
					}
	      }
	      else {
	      	$oldLanguages = UserModel::getUserLangueMaitrisee($pseudo);
	      	foreach ($oldLanguages['spokenLang'] as $key => $language) {
					  UserModel::deleteUserLang($pseudo, $language);
					}
	      }
	     	

				if(isset($json['languages']) && $json['languages'] != '') { //A modifier avec le front !
			    $newLanguages = $json['languages'];
			    foreach ($newLanguages as $key => $language) {
			    	UserModel::setUserLang($pseudo, $language, $level);
			    }
				}
			}


	  }
	}
	else $data = array("Error", "Error");

  

  echo json_encode($data);

?>