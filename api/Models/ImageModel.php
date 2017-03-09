<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class ImageModel{
    
    // Enregistre la balise img html pour afficher l'image dans la conversation
    public static function uploadImageMessage($url, $pseudo, $id_conv) {
        $bdd = Database::connexionBDD();
        $id_user = UserModel::getUserId($pseudo);
        $contenu = "<img alt='Message' src='".$url."'/>";
        
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
    
    //Récupère la balise image pour la réafficher dans la conversation
    public static function getImageMessage () {
        
    }
    
    //Enregistre l'avatar d'un utilisateur
    public static function uploadAvatar() {
        
    }
    
    //Va chercher l'avatar d'un utilisateur :
    public static function getAvatar() {
        
    }

}