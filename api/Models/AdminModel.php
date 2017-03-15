<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class AdminModel{
    
    /* Renvoie toutes les photos en attente de validation */
    public static function getPendingPictures(){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('SELECT `ID`, `pseudo`, `avatar` FROM `user` WHERE avatar_state = 0');
        $req_get->execute();
        $result = Array('users' => $req_get->fetchAll());
        return $result;  
    }
    
    /* Valide la photo (passe son état à 1) */
    public static function approvePicture($pseudo){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('UPDATE user SET avatar_state = 1 WHERE pseudo = :pseudo');
        $req_get->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 60);
        $req_get->execute();  
    }

    public static function refusePicture($pseudo){
        $bdd = Database::connexionBDD();
        
        $req_get = $bdd->prepare('UPDATE user SET avatar = "" WHERE pseudo = :pseudo.');
        $req_get->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 60);
        $req_get->execute();
        $req_get = $bdd->prepare('UPDATE user SET avatar_state = "2" WHERE pseudo = :pseudo.');
        $req_get->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 60);
        $req_get->execute();
    }


    public static function checkUsernamePassword($username, $password){
        $bdd = Database::connexionBDD();
        
        $req_id = $bdd->prepare('SELECT password, username FROM admin');
        $req_id->execute();
        $result = $req_id->fetch(PDO::FETCH_ASSOC);

        if($result['password'] == md5($password) && $result['username'] == $username) {
            return 'true';
        }
        else return 'false';

    }
}

?>