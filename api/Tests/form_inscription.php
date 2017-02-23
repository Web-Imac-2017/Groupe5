<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>plume</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body>
	<h2>Inscription Plume</h2>
	
	<p> Pas encore inscrit ? Suivez le formulaire en bas :</p>
	<form method="post" action="inscription.php" enctype="multipart/form-data">
	    <label for="nom">Nom</label> : <input type="text" name="nom" id="nom" value="<?php if(isset($_SESSION['nom'])&&!empty($_SESSION['nom'])){ echo $_SESSION['nom']; } ?>"><br/>
		<label for="prenom">Prenom</label> : <input type="text" name="prenom" id="prenom" value="<?php if(isset($_SESSION['prenom'])&&!empty($_SESSION['prenom'])){ echo $_SESSION['prenom']; } ?>"><br/>
		<label for="pseudo_i">Pseudo</label> : <input type="text" name="pseudo_i" id="pseudo_i" value="<?php if(isset($_SESSION['pseudo'])&&!empty($_SESSION['pseudo'])){ echo $_SESSION['pseudo']; } ?>"><br/>
		<label for="email">Email</label> : <input type="text" name="email" id="email" value="<?php if(isset($_SESSION['email'])&&!empty($_SESSION['email'])){ echo $_SESSION['email']; } ?>"><br/>
		<label for="mdp_i">Mot de passe</label> : <input type="password" name="mdp_i" id="mdp_i"><label for="mdp_i"> Peu contenir : lettres, chiffres, "_", "-". Vous devez entrer entre 6 et 12 caractères.</label><br/>
		<input type="submit" value="Je m'inscris !">
	</form>
	
	<?php
		if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
			
			echo $_SESSION['errors'][0];
		}
		
		session_destroy();
	?>
</body>
</html>