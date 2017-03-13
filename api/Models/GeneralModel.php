<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class GeneralModel{
    
    public static function getAllHobbies(){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('SELECT Nom as name FROM centre_interet ORDER BY Nom');
        $req_get->execute();
        $result = array();
        $result['hobbies'] = $req_get->fetchAll();
        return $result;  
    }
    
    public static function getAllLanguages(){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('SELECT Nom as name FROM langue ORDER BY Nom');
        $req_get->execute();
        $result = array();
        $result['languages'] = $req_get->fetchAll();
        return $result;  
    }

    public static function getAllCountries(){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('SELECT nom_pays as name FROM table_pays WHERE code != "00" ORDER BY nom_pays');
        $req_get->execute();
        $result = array();
        $result['countries'] = $req_get->fetchAll();
        return $result;  
    }
}

?>