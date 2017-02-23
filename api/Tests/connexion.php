<?php
session_start();
?>

<!DOCTYPE>
<html>
	<head>
		<title>PLUME | Connexion</title>
		<meta http-equiv="Content-Type"  charset="utf-8"/>
	</head>
<body>

<header>

</header>

<div id="connexion">
<form method="post" action="verif_connexion.php">
	<h1>Connexion</h1>
	<p>Pseudo:</p><br>
	<input type="text" name="pseudo" id ="pseudo"/><br>
	<p>Mot de passe:</p><br>
	<input type="password" name="password" id ="password"/><br><br>
	<input id="submit" type="submit" value="Se connecter"/>
</form>
</div>
</body>
</html>

