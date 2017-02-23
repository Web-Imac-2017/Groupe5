<?php
session_start();

if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['password'])){
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];


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

    //Recuperation des identifiants dans la bdd :
	$req_ident = $bdd->prepare('SELECT pseudo FROM user WHERE pseudo = "'.$pseudo.'"');
	$req_ident->execute();

	if($req_ident->fetch()){
        //var_dump($donnees);
			$req_password = $bdd->prepare('SELECT password FROM user WHERE pseudo = "'.$pseudo.'"');
			$req_password->execute();
			$recup_password = $req_password->fetch();
            $password_hach = md5($password);
            
            //var_dump($recup_password);
            //echo "Mot de passe : ".$recup_password["password"];
            //echo "Mot de passe hach :   ".$password_hach;
            
            if($password_hach == $recup_password["password"]){
                echo "Ok c'est bon";
                //Envoi de la variable de d'etat du user :
                $req_active = $bdd->prepare('UPDATE user SET id_etat_activite = 1 WHERE pseudo = "'.$pseudo.'"');
                $req_active->execute();
                //var_dump($req_active->errorinfo());
                //header ("location:...");
            }
		  else{
             echo "Mauvais mot de passe";
		}
	   }
    else{
        echo "L'identifiant n'existe pas";
    }
}
else{
    echo "Les variables ne sont pas initialisée";
}

?>