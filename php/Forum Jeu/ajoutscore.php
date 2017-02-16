<?php
session_start();
//Ici le but est de vérifier login + nb dans url puis d'ajouter le score à la BDD

if(isset($_SESSION['login']) && isset($_GET['score']) && !empty($_SESSION['login']) && !empty($_GET['score'])){
	
	$login = $_SESSION['login'];
	$score = $_GET['score'];
	
	//echo $_SESSION['login'], $_GET['score'];
	
	if(ctype_digit($score) && $score > 0 && $score < 250){
		$bdlink = new PDO('mysql:host=localhost;dbname=jv394874', 'jv394874_admin', 'jv394874');
		$sql = $bdlink->prepare('INSERT INTO scoresTest VALUES(NULL, :login, now(), :score);');
		$sql->execute(array(':login' => $login, ':score' => $score));
	}
	
} else {
	
	echo "Un problèm est survenue dans votre session pour vous reconnecter : <a href='index.php'>cliquez ici !</a>";
}
?>