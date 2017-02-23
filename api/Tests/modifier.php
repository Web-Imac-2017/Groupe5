<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=plume;charset=utf8', 'root', '');

$errors = [];
	if(empty($_SESSION['login'])){
		array_push($errors, 'Le login existe pas !');
	}
	$sth = $bdd->prepare("SELECT pseudo FROM user WHERE pseudo = :login");
	$sth->execute(array(':login' => $_SESSION['login']));
	print_r($sth->errorinfo());
	
	$regexp = '#^[0-9A-z+\-<>_]{6,12}$#';
	$avatarExp = '#^image/(png|jpeg|gif)$#i';
	
	if ($sth->rowcount()){
		if(isset($_POST['prenom'])&&!empty($_POST['prenom'])){
			$req = $bdd->prepare('UPDATE user SET prenom = :prenom WHERE pseudo = :login');
			$req->execute(array(
				'prenom' => $_POST['prenom'],
				'login' => $_SESSION['login'],
				));
		}

		if(isset($_POST['nom'])&&!empty($_POST['nom'])){
			$req = $bdd->prepare('UPDATE user SET nom = :nom WHERE pseudo = :login');
			$req->execute(array(
				'nom' => $_POST['nom'],
				'login' => $_SESSION['login'],
				));
		}

		if(isset($_POST['mdp'])&&!empty($_POST['mdp'])){
			$req = $bdd->prepare('UPDATE user SET password = :mdp WHERE pseudo = :login');
			$req->execute(array(
				'mdp' => MD5($_POST['mdp']),
				'login' => $_SESSION['login'],
				));
		}

		if(isset($_POST['email'])&&!empty($_POST['email'])){
			$req = $bdd->prepare('UPDATE user SET email = :email WHERE pseudo = :login');
			$req->execute(array(
				'email' => $_POST['email'],
				'login' => $_SESSION['login'],
				));
		}

		if(isset($_POST['description'])&&!empty($_POST['description'])){
			$req = $bdd->prepare('UPDATE user SET description = :description WHERE pseudo = :login');
			$req->execute(array(
				'description' => $_POST['description'],
				'login' => $_SESSION['login'],
				));
		}	
	}
	else{ 
		array_push($errors, 'Le login existe pas ! ');
		
		$_SESSION['errors'] = $errors;
		header('Location: index.php');
	}
?>
