<?php
session_start();

if(isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])){
    $pseudo = $_SESSION["pseudo"];
    
    //echo "pseudo :".$pseudo."\n";
    //echo "Password : ".$password."\n";

	//Connexion à la bdd:
	try{
	   $options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
	   $bdd = new PDO('mysql:host=localhost;dbname=plume','root','' , $options);	
	}
	catch (Exception $e){
		die('Erreur: '.$e->getMessage());
	}

    $req_deco = $bdd->prepare('UPDATE user SET id_etat_activite = 0 WHERE pseudo = "'.$pseudo.'"');
    $req_deco->execute();
}
else{
    echo "Les variables ne sont pas initialisée";
}
?>