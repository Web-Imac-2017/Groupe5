<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=plume','root','');

$pays = $bdd-> query('SELECT fr FROM table_pays');
while($data = $pays->fetch()){
	echo json_encode($data['fr']);
}



$ctrInteret = $bdd-> query('SELECT nom FROM centre_interet');
while($data = $ctrInteret->fetch()){
	echo json_encode($data['nom']);
}

?>