<?php 
  session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/UserModel.php";


	$pseudo = "";
	$newHobbies = "";
	$data = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		$json = json_decode(file_get_contents('php://input'), true);
		if(!is_array($json)) $data = array("Error", "Error: Post");
		else {
			if(isset($json['pseudo'])) {
       $pseudo = $json['pseudo'];
      }

      $oldHobbies = UserModel::getUserHobbies($pseudo);
     	foreach ($oldHobbies as $key => $hobby) {
		    UserModel::deleteUserHobbies($pseudo, $hobby);
		  }

	    if(isset($json['hobbies']) && $json['hobbies'] != '') { 
		    $newHobbies = $json['hobbies'];
		    foreach ($newHobbies as $key => $hobby) {
		    	UserModel::setUserHobbies($pseudo, $hobby);
		    }
			}
		
	  }
	}
	else $data = array("Error", "Error");

  echo json_encode($data);

?>