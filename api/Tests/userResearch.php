<?php

public static function userResearch($searched) { //La variable $searched est ce que l'utilisateur a entré dans le champ de recherche
        $bdd = Database::connexionBDD();
        // On cherche tous les pseudos contenant la suite de caractères entrée
        $searchResults = $bdd->prepare('SELECT pseudo FROM user WHERE pseudo LIKE "%'.$searched.'%"');
        $searchResults->execute();

        if($searchResults->fetch()){
        	$result = $searchResults->fetch();
        }
        else {
            $result = array("Error", "Error: We can't find what you searched");
        }
        
        return $result;
    }

?>