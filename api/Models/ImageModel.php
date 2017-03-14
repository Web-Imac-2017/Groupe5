<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class ImageModel{
    
    // Enregistre la balise img html pour afficher l'image dans la conversation
    public static function uploadImageMessage($url, $pseudo, $id_conv) {
        $bdd = Database::connexionBDD();
        $id_user = UserModel::getUserId($pseudo);
        $contenu = "PLUME_IMAGE_MESSAGE:".$url;
        
        $req_active = $bdd->prepare("INSERT INTO `message`(`ID`, `contenu`, `date`, `id_user`, `id_conversation`) VALUES (NULL,:contenu, now(), :id_user, :id_conv)");

        $result = $req_active->execute(array(':contenu' => $contenu, ':id_user' => $id_user, ':id_conv' => $id_conv));
        
        if($result){
            $data = $result;
        }
        else {
            $data = array("Error", "The request doesn't work");
        }
        
        return $data;
    }
    
    
    //Enregistre l'avatar d'un utilisateur
    public static function uploadAvatar($url, $pseudo) {
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare("UPDATE `user` SET `avatar` = :avatar WHERE `pseudo` =:pseudo");
        $result = $req_active->execute(array(':avatar' => $url, ':pseudo' => $pseudo));
        
        if($result){
            $data = $result;
        }
        else {
            $data = array("Error", "The request doesn't work");
        }
        
        return $data;
    }
    
    //Va chercher l'avatar d'un utilisateur :
    public static function getAvatar($pseudo) {
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare("SELECT `avatar` FROM `user` WHERE `pseudo`= :pseudo");
        $req_active->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 60);
        $req_active->execute();
        
        if($result = $req_active->fetch(PDO::FETCH_ASSOC)){
            $data = array($result['avatar'], $pseudo);
        }
           else{
            $data = array(0);
        }
        
           return $data;   
    }

}