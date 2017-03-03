<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class GeneralModel{
    
    public static function getAllHobbies(){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('SELECT nom FROM centre_interet');
        $req_get->execute();
        
        $result= array('Hobbies' => array());
        while($req_get = $req_get->fetch(PDO::FETCH_ASSOC)){
            $result['Hobbies'][] = $req_get["Nom"];
        }
        return $result;  
    }
    
    public static function getAllLanguages(){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('SELECT Nom FROM langue');
        $req_get->execute();
        
        $result= array('Languages' => array());
        while($req_get = $req_get->fetch(PDO::FETCH_ASSOC)){
            $result['Languages'][] = $req_get["Nom"];
        }
        return $result;  
    }
}

?>