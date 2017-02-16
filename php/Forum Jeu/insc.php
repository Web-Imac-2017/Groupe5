<?php
session_start();

require_once('motsdepasse/password.php');

$errors = [];

if(isset($_POST['loginIns'])&&!empty($_POST['loginIns'])
	&&isset($_POST['prenomIns'])&&!empty($_POST['prenomIns'])
	&&isset($_POST['nomIns'])&&!empty($_POST['nomIns'])
	&&isset($_POST['mdpIns'])&&!empty($_POST['mdpIns'])
	&&isset($_POST['emailIns'])&&!empty($_POST['emailIns'])
	&&isset($_POST['pseudoIns'])&&!empty($_POST['pseudoIns'])){


	$bdlink = new PDO('mysql:host=localhost;dbname=jv394874', 'jv394874_admin', 'jv394874'); //après ";" => nom base de donnée, nom admin, mdp

	$sth = $bdlink->prepare("SELECT login FROM utilisateur WHERE login = :login");
	$sth->execute(array(':login' => $_POST['loginIns']));
	print_r($sth->errorinfo());
	
	$regexp = '#^[0-9A-z+\-<>_]{6,12}$#';
	$avatarExp = '#^image/(png|jpeg|gif)$#i';
	
	if ($sth->rowcount()){
		echo 'Le login existe déjà ! Choisissez-en un autre !';
		array_push($errors, "Le login existe déjà ! Choisissez-en un autre !");
		
		$_SESSION['errors'] = $errors;
		header('Location: index.php');
	}
	else{ if(preg_match($regexp, $_POST['mdpIns'])){
	
			$sth = $bdlink->prepare("INSERT INTO utilisateur VALUES (:login, :prenom, :nom, :mdp, :email, curdate(), :pseudo, :avatar)");
			$sth->execute(array(':login' => $_POST['loginIns'], ':prenom' => $_POST['prenomIns'],':nom' => $_POST['nomIns'], ':mdp' => password_hash($_POST['mdpIns'], PASSWORD_DEFAULT), ':email' => $_POST['emailIns'], ':pseudo' => $_POST['pseudoIns'], ':avatar' => '0'));
			print_r($sth->errorinfo());

			$_SESSION['login'] = $_POST['loginIns'];
			echo "Votre inscription a été prise en compte ! Pour accéder à votre profil : <a href='profil.php'>Cliquez ici !</a>";
			$_SESSION['Inscription'] = 1;
		
			if(is_uploaded_file($_FILES['fileUpload']['tmp_name'])){  //format[0] => width / format[1] => height
				
				$format = getimagesize($_FILES['fileUpload']['tmp_name']);
				$verif_format = preg_match($avatarExp, $format['mime'], $tab);
				
				if($format[0] > 0 && $format[1] > 0 && !empty($tab[1]) && verif_format){
					
					$mime = $tab[1];
					$openimage = 'imagecreatefrom'.$tab[1];
					$source = $openimage($_FILES['fileUpload']['tmp_name']);
					$dest = imagecreatetruecolor(120, 120);
			
					imagecopyresampled($dest, $source, 0, 0, 0, 0, 120, 120, $format[0], $format[1]);
					imagepng($dest, 'images/avatars/'.$_POST['loginIns'].'.png');
					
					$avatar = $bdlink->prepare("UPDATE utilisateur SET avatar = 1 WHERE login = :login");
					$avatar->execute(array(':login' => $_POST['loginIns']));
					
				}else {
					echo "Il y a un problème avec votre fichier !";
					array_push($errors, "Votre fichier n'est pas une image ! Vous aurez donc l'avatar par défaut !");
					
				}
			}else{
				echo "Vous n'avez pas uploadé d'image, vous aurez alors l'avatar par défault !";
				array_push($errors, "Vous n'avez pas uploadé de fichier ! Vous aurez donc l'avatar par défaut !");
			}
			
			$_SESSION['errors'] = $errors;
			header('Location: profil.php');
		
		}else{
			echo 'Votre mot de passe est incorrect ! Pour le modifier retour au formulaire : <a href="index.php">cliquez ici !</a>';
			array_push($errors, "Attention, vous n'avez pas saisi un mot de passe valide !");
			
			$_SESSION['errors'] = $errors;
			header('Location: index.php');
		}
	}
	
} else {
echo 'Vous n\'avez pas rempli toutes les lignes du formulaire pour y retourner : <a href="index.php">cliquez ici !</a>';
array_push($errors, "Vous n'avez pas rempli tous les champs du formulaire !");
	
$_SESSION['errors'] = $errors;
header('Location: index.php');
}
?>