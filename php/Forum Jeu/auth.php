<?php
session_start();

require_once('motsdepasse/password.php');

$errors = [];

if(isset($_POST['login'])&&isset($_POST['mdp'])&&!empty($_POST['login'])&&!empty($_POST['mdp'])) {
	$login=$_POST['login'];
	$mdp=$_POST['mdp'];

	$bdlink = new PDO('mysql:host=localhost;dbname=jv394874', 'jv394874_admin', 'jv394874'); //après ";" => nom base de donnée, nom admin, mdp

	$sth = $bdlink->prepare("SELECT mdp FROM utilisateur WHERE login = :login");
	$sth->execute(array(':login' => $login));
	//print_r($sth->errorinfo());
	
	if ($sth->rowcount()){
		$mdp_hach = $sth->fetchColumn();
		
		if(password_verify($mdp, $mdp_hach)){
			echo "Bienvenu $login Vous êtes connecté ! <br/>";
			
			$_SESSION['login'] = $login;
			
			echo "Pour accéder à votre profil : <a href='profil.php'>Cliquez ici !</a>";
			header('Location: profil.php');
			
		} else{
			echo "Attention, vous n'avez pas saisi le bon mot de passe !";
			array_push($errors, "Attention, vous n'avez pas saisi le bon mot de passe !");
			
			$_SESSION['errors'] = $errors;
			header('Location: index.php');
		}
	}
	else{
		echo "Vous n'avez pas saisi le bon login !";
		array_push($errors, "Vous n'avez pas saisi le bon login !");
		
		$_SESSION['errors'] = $errors;
		header('Location: index.php');
	}
} else {
	echo 'Vous vous êtes trompé pour revenir au formulaire : <a href="index.php">cliquez ici !</a>';
	array_push($errors, "Vous n'avez pas rempli les champs du formulaire !");
	
	$_SESSION['errors'] = $errors;
	header('Location: index.php');
}

?>