<?php
session_start();

echo "<head><meta charset='UTF-8'><link rel='stylesheet' type='text/css' href='css/style.css'></link></head>";

$bdlink = new PDO('mysql:host=localhost;dbname=jv394874', 'jv394874_admin', 'jv394874');

if(isset($_SESSION['login'])){

	$login = $_SESSION['login'];
	
	if(isset($_SESSION['errors'])&&!empty($_SESSION['errors'])){
		foreach ($_SESSION['errors'] as $value){
			echo $value;
		}
	}
	
	echo "<h1>$login</h1>";

	$img = $bdlink->prepare("SELECT * FROM utilisateur WHERE login = :login");
	$img->execute(array(':login' => $login));
	$data = $img->fetch();
	$avatar = $data['avatar'];
	$pseudo = $data['pseudo'];
	echo "Bonjour ! $pseudo<br/>";
	
	if(isset($_SESSION['Inscription'])&&!empty($_SESSION['Inscription'])){
		echo "Votre inscription a bien été prise en compte voici votre profil !</br>";
	}
		
	if($avatar == 1){
		echo "Voici votre image actuelle d'avatar : <img alt='avatar' src='images/avatars/$login.png'/><br/>";
	}else if($avatar == 0){
		echo "Voici votre image actuelle d'avatar : <img alt='avatar' src='images/avatars/default.png'/><br/>";
	}
	
	//Change l'image d'avatar !
	
	echo "<p>Pour changer votre image d'avatar remplissez le formulaire en bas :</p>
		<form method='post' action='image.php' enctype='multipart/form-data'>
			<label for='fileUpload'>Image d'Avatar</label> : <input type='file' name='fileUpload' id='fileUpload'><br/>
			<input type='submit' value='Nouvelle Avatar'>
		</form>";
		
	//Lien vers jeu
	echo "<p>Pour jouer à mon super jeu de Tape Taupe <a href='http://vulpecula6/~jv394874/JeuS3/TapeTaupe/'>Cliquez-ici !</a></p>";
	
	//Afficher Stats
	echo '<h2>Tes Stats</h2>';
	
	$sqlpj = $bdlink->prepare('SELECT COUNT(ID) as nbparties FROM scoresTest INNER JOIN utilisateur ON login=idJoueur WHERE login = :login');
	$sqlpj->execute(array(':login' => $login));
	$data = $sqlpj->fetch();
	echo "<p>En tout tu as joué ".$data[0]." parties.</p>";
	
	$sqlsm = $bdlink->prepare('SELECT AVG(valeur) as scoreMoyen FROM scoresTest INNER JOIN utilisateur ON login=idJoueur WHERE login=:login');
	$sqlsm->execute(array(':login' => $login));
	$data = $sqlsm->fetch();
	echo "<p>Pour un score moyen de ".$data[0].".</p>";
	
	$sqlms = $bdlink->prepare('SELECT MAX(valeur) as meilleurScore FROM scoresTest INNER JOIN utilisateur ON login=idJoueur WHERE login=:login');
	$sqlms->execute(array(':login' => $login));
	$data = $sqlms->fetch();
	echo "<p>Et un record de ".$data[0].".</p>";
	
	echo '<h2>Stats Globales</h2>';
	
	$sqlnbj = $bdlink->query('SELECT COUNT(distinct idJoueur) FROM scoresTest');
	$data = $sqlnbj->fetch();
	echo "<p>En tout ".$data[0]." joueurs ont joués à ce jour.</p>";
	
	$sqlnbp = $bdlink->query('SELECT COUNT(ID) as nbparties FROM scoresTest');
	$data = $sqlnbp->fetch();
	echo "<p>Ayant joué ".$data[0]." parties.</p>";
	
	$sqlvalm = $bdlink->query('SELECT AVG(valeur) as scoreMoyen FROM scoresTest');
	$data = $sqlvalm->fetch();
	echo "<p>Pour un valeur moyenne de ".$data[0].".</p>";
	
	$sqlmsj = $bdlink->query('SELECT pseudo, valeur FROM scoresTest INNER JOIN utilisateur ON login=idJoueur ORDER BY valeur DESC LIMIT 5');
	echo "<h4>Les 5 meilleurs scores obtenus sont :</h4><table><tr><th>Pseudo</th><th>Score</th></tr>";
	while($data = $sqlmsj->fetch()){
		echo "<tr>";
		echo "<td>".$data[0]."</td>";
		echo "<td>".$data[1]."</td>";
		echo "</tr>";
	}
	echo '</table>';
	
	$sqlmj = $bdlink->query('SELECT pseudo, MAX(valeur) as meilleurScore FROM scoresTest INNER JOIN utilisateur ON login=idJoueur group by idJoueur ORDER BY meilleurScore DESC LIMIT 5');
	echo "<h4>Les 5 meilleurs joueurs sont :</h4><table><tr><th>Joueurs</th><th>Scores</th></tr>";
	while($data = $sqlmj->fetch()){
		echo "<tr>";
		echo "<td>".$data[0]."</td>";
		echo "<td>".$data[1]."</td>";
		echo "</tr>";
	}
	echo '</table>';
	
	$sqlmm = $bdlink->query('SELECT pseudo, AVG(valeur) as scoreMoyen FROM scoresTest INNER JOIN utilisateur ON login=idJoueur group by idJoueur ORDER BY scoreMoyen DESC LIMIT 5');
	echo "<h4>Les 5 meilleurs moyennes ont été obtenues par :</h4><table><tr><th>Joueurs</th><th>Scores</th></tr>";
	while($data = $sqlmm->fetch()){
		echo "<tr>";
		echo "<td>".$data[0]."</td>";
		echo "<td>".$data[1]."</td>";
		echo "</tr>";
	}
	echo '</table>';
	
	$sqlja = $bdlink->query('SELECT pseudo, COUNT(ID) as nbpartie FROM scoresTest INNER JOIN utilisateur ON login=idJoueur GROUP BY idJoueur ORDER BY nbpartie DESC LIMIT 0,5');
	echo "<h4>Les 5 joueurs les plus accros sont :</h4><table><tr><th>Joueurs</th></tr>";
	while($data = $sqlja->fetch()){
		echo "<tr>";
		echo "<td>".$data[0]."</td>";
		echo "</tr>";
	}
	echo '</table>';
	
	echo '<h2>Stats du Jour</h2>';
	
	$sqlpj = $bdlink->query('SELECT valeur, dateScore FROM scoresTest WHERE day(dateScore)=day(now()) AND month(dateScore)=month(now()) AND year(dateScore)=year(now())');
	$data = $sqlpj->fetch();
	echo "<p>Aujourd'hui ".$data[0]." parties ont été jouées.</p>";
	
	$sqljj = $bdlink->query('SELECT count( distinct idJoueur), dateScore FROM scoresTest WHERE day(dateScore)=day(now()) AND month(dateScore)=month(now()) AND year(dateScore)=year(now())');
	$data = $sqljj->fetch();
	echo "<p>Par ".$data[0]." joueurs.</p>";
	
	$sqlmj = $bdlink->query('SELECT AVG(valeur) as valeurMoyenne, dateScore FROM scoresTest WHERE day(dateScore)=day(now()) AND month(dateScore)=month(now()) AND year(dateScore)=year(now())');
	$data = $sqlmj->fetch();
	echo "<p>Pour une moyenne de ".$data[0].".</p>";
	
	$sqlmsj = $bdlink->query('SELECT MAX(valeur) as meilleureValeure, dateScore FROM scoresTest WHERE day(dateScore)=day(now()) AND month(dateScore)=month(now()) AND year(dateScore)=year(now())');
	$data = $sqlmsj->fetch();
	echo "<p>Et un meilleur score de ".$data[0].".</p>";
	
	
} else{
	echo "une erreur est survenue pour retourner à la page d'authentification : <a href='index.php'>cliquez ici !</a>";
}

unset($_SESSION['Inscription']);
unset($_SESSION['errors']);
?>