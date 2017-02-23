<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=plume','root','');

// $login=$_SESSION('login');
$login='Robibidu77';

echo json_encode($login);

$id = $bdd-> prepare('SELECT ID FROM user WHERE pseudo=:login');
$id->execute(array(':login' => $login));
$identifiant = $id->fetch();

$nom = $bdd-> prepare('SELECT nom FROM user WHERE ID=:id');
$nom->execute(array(':id'=>$identifiant[0]));
$nom = $nom->fetch();
echo json_encode($nom['nom']);


$prenom = $bdd-> prepare('SELECT prenom FROM user WHERE ID=:id');
$prenom->execute(array(':id'=>$identifiant[0]));
$prenom = $prenom->fetch();
echo json_encode($prenom['prenom']);


$description = $bdd-> prepare('SELECT description FROM user WHERE ID=:id');
$description->execute(array(':id'=>$identifiant[0]));
$data = $description->fetch();
echo json_encode($data['description']);

$pays = $bdd-> prepare('SELECT fr FROM table_pays INNER JOIN user ON user.id_pays = table_pays.id_pays WHERE user.ID=:id');
$pays->execute(array(':id'=>$identifiant[0]));
$data = $pays->fetch();
//var_dump($data);
echo json_encode($data['fr']);

$activite = $bdd-> prepare('SELECT nom FROM etat_activite INNER JOIN user ON user.id_etat_activite = etat_activite.ID WHERE user.ID=:id');
$activite->execute(array(':id'=>$identifiant[0]));
while($data = $activite->fetch()){
	echo json_encode($data['nom']);
}

$languesMait = $bdd-> prepare('SELECT langue.Nom FROM langue INNER JOIN user_langue ON langue.ID = user_langue.id_langue WHERE user_langue.id_user=:id AND user_langue.maitrise = 1');
$languesMait->execute(array(':id'=>$identifiant[0]));
while($data = $languesMait->fetch()){
	echo json_encode($data['langue.Nom']);
}

$languesApp = $bdd-> prepare('SELECT langue.Nom FROM langue INNER JOIN user_langue ON langue.ID = user_langue.id_langue WHERE user_langue.id_user=:id AND user_langue.maitrise = 0');
$languesApp->execute(array(':id'=>$identifiant[0]));
while($data = $languesApp->fetch()){
	echo json_encode($data['langue.Nom']);
}

$interet = $bdd-> prepare('SELECT centre_interet.Nom FROM centre_interet INNER JOIN user_centre_interet ON centre_interet.ID = user_centre_interet.id_interet WHERE user_centre_interet.id_user=:id');
$interet->execute(array(':id'=>$identifiant[0]));
while($data = $interet->fetch()){
	echo json_encode($data['Nom']);
}

?>