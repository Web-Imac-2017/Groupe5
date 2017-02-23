<?php
session_start();

$errors = [];

if(isset($_POST['prenom'])&&!empty($_POST['prenom'])
	&&isset($_POST['nom'])&&!empty($_POST['nom'])
	&&isset($_POST['mdp_i'])&&!empty($_POST['mdp_i'])
	&&isset($_POST['email'])&&!empty($_POST['email'])
	&&isset($_POST['pseudo_i'])&&!empty($_POST['pseudo_i'])){

	$bdlink = new PDO('mysql:host=localhost;dbname=plume', 'root', ''); //après ";" => nom base de donnée, nom admin, mdp

	$sth = $bdlink->prepare("SELECT pseudo FROM user WHERE pseudo = :pseudo");
	$sth->execute(array(':pseudo' => $_POST['pseudo_i']));
	/*print_r($sth->errorinfo());*/
	
	/*$regexp = '#^[0-9A-z+\-<>_]{6,12}$#';
	$avatarExp = '#^image/(png|jpeg|gif)$#i';*/
    
    /* sauvegarde des données pour les ré-afficher dans le formulaire */
    $_SESSION['pseudo'] = $_POST['pseudo_i'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['email'] = $_POST['email'];
	
	if ($sth->rowcount()){ /* verif pseudo unique */
		array_push($errors, "Le Pseudo '".$_POST['pseudo_i']."' existe déjà ! Choisissez-en un autre !");
		
		$_SESSION['errors'] = $errors;
		header('Location: form_inscription.php');
	}
	else{ 
        
        $sth = $bdlink->prepare("SELECT email FROM user WHERE email = :email");
        $sth->execute(array(':email' => $_POST['email']));
        /*print_r($sth->errorinfo());*/
        
        if($sth->rowcount()){ /* verif email unique */
            
			array_push($errors, "Attention, l'email '".$_POST['email']."' est déjà utilisé pour un compte !");
			
			$_SESSION['errors'] = $errors;
			header('Location: form_inscription.php');
		
		}else{
            
            $sth = $bdlink->prepare("INSERT INTO user (nom, prenom, pseudo, email, password, date_inscription, derniere_connexion) VALUES (:nom, :prenom, :pseudo, :email, :mdp, curdate(), curdate())");
			$sth->execute(array(':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'],':pseudo' => $_POST['pseudo_i'], ':email' => $_POST['email'], ':mdp' => md5("sel".$_POST['mdp_i'])));
			print_r($sth->errorinfo());

			/*$_SESSION['pseudo'] = $_POST['pseudo_i'];*/
            
			/*$_SESSION['Inscription'] = 1;*/
			
			$_SESSION['errors'] = $errors;
            
            echo "inscription réussie !";
            
            /*mail de confirmation d'inscription*/
            $objet = $_SESSION['pseudo'].", bienvenue sur Plume !";
            $message = $_SESSION['prenom']." ".$_SESSION['nom'].", bienvenue sur Plume !";
            $headers = 'FROM: justine.vuillemot@orange.fr';

            mail($_SESSION['email'], $objet, $message, $headers);
		}
	}
	
} else {
    /*sauvegarde des champs entrés*/
    if(isset($_POST['prenom'])&&!empty($_POST['prenom'])){
        $_SESSION['prenom'] = $_POST['prenom'];
    }
    
    if(isset($_POST['nom'])&&!empty($_POST['nom'])){
        $_SESSION['nom'] = $_POST['nom'];
    }
    
    if(isset($_POST['email'])&&!empty($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
    }
    
    if(isset($_POST['pseudo_i'])&&!empty($_POST['pseudo_i'])){
        $_SESSION['pseudo'] = $_POST['pseudo_i'];
    }
    
    
    array_push($errors, "Vous n'avez pas rempli tous les champs du formulaire !");

    $_SESSION['errors'] = $errors;
    header('Location: form_inscription.php');
}
?>