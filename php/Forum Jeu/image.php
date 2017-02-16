<?php
session_start();

$login = $_SESSION['login'];

$errors = [];

$bdlink = new PDO('mysql:host=localhost;dbname=jv394874', 'jv394874_admin', 'jv394874');

$avatarExp = '#^image/(png|jpeg|gif)$#i';

if(is_uploaded_file($_FILES['fileUpload']['tmp_name'])){  //format[0] => width / format[1] => height
				
	$format = getimagesize($_FILES['fileUpload']['tmp_name']);
	$verif_format = preg_match($avatarExp, $format['mime'], $tab);
				
	if($format[0] > 0 && $format[1] > 0 && !empty($tab[1]) && $verif_format){
					
		$mime = $tab[1];
		$openimage = 'imagecreatefrom'.$tab[1];
		$source = $openimage($_FILES['fileUpload']['tmp_name']);
		$dest = imagecreatetruecolor(120, 120);
			
		imagecopyresampled($dest, $source, 0, 0, 0, 0, 120, 120, $format[0], $format[1]);
		imagepng($dest, 'images/avatars/'.$login.'.png');
					
		$avatar = $bdlink->prepare("UPDATE utilisateur SET avatar = 1 WHERE login = :login");
		$avatar->execute(array(':login' => $login));
		
		echo "Votre nouvelle image a bien été prise en compte. Pour retourner sur votre profil : <a href='profil.php'>Cliquez ici !</a>";
		header('Location: profil.php');
		
	}else {
		echo "Il y a un problème avec votre fichier !";
		array_push($errors, "Votre fichier n'est pas une image ! Vous aurez donc l'avatar par défaut !");
		
		$_SESSION['errors'] = $errors;
		header('Location: profil.php');
	}
}else{
	echo "Vous n'avez pas uploadé d'image, vous aurez toujours l'avatar précédant ! Pour retourner sur votre profil : <a href='profil.php'>Cliquez ici !</a>";
	array_push($errors, "Vous n'avez pas uploadé de fichier ! Vous aurez donc l'avatar par défaut !");
	
	$_SESSION['errors'] = $errors;
	header('Location: profil.php');
}

?>