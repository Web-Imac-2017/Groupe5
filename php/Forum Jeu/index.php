<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>plume</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>


<body>
	<div id="centrer">
	<h2>Inscription Plume</h2>

	<p>Mais avant tout, identifie toi !</p>
	<!-- Début du formulaire -->
	<form method="post" action="auth.php">
		<label for="login">Login</label> : <input type="text" name="login" id="login">
		<label for="mdp">Mot de passe</label> : <input type="password" name="mdp" id="mdp">
		<input type="submit" value="J'entre !">
	</form>
	
	<p> Pas encore inscrit ? Suivez le formulaire en bas :</p>
	<form method="post" action="insc.php" enctype="multipart/form-data">
	<!-- le Ins à la fin signifie dans le formulaire d'inscription -->
		<label for="login">Login</label> : <input type="text" name="loginIns" id="loginIns"><br/>
		<label for="prenom">Prenom</label> : <input type="text" name="prenomIns" id="prenomIns"><br/>
		<label for="nom">Nom</label> : <input type="text" name="nomIns" id="nomIns"><br/>
		<label for="mdp">Mot de passe</label> : <input type="password" name="mdpIns" id="mdpIns"><label for="mdp"> Peu contenir : lettres, chiffres, +, _, -, &lt;, &gt;. Vous devez entrer entre 6 et 12 caractères.</label><br/>
		<label for="email">Email</label> : <input type="text" name="emailIns" id="emailIns"><br/>
		<label for="pseudo">Pseudo</label> : <input type="text" name="pseudoIns" id="pseudoIns"><br/>
		<label for="fileUpload">Image d'Avatar</label> : <input type="file" name="fileUpload" id="fileUpload"><br/>
		<input type="submit" value="Je m'inscris !">
	</form>
	
	<?php
		if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
			
			echo $_SESSION['errors'][0];
		}
		
		session_destroy();
	?>
	</div>
</body>
</html>