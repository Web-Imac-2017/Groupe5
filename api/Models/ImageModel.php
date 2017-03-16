<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');
require_once('../../Models/ConversationModel.php');

class ImageModel{
    
    // Enregistre la balise img html pour afficher l'image dans la conversation
    public static function uploadImageMessage($url, $pseudo, $id_conv) {
        $bdd = Database::connexionBDD();
        //$id_user = UserModel::getUserId($pseudo);
        $contenu = "PLUME_IMAGE_MESSAGE".$url;
        
        $data = array();

        /*cryptage message*/
        $id_sender = UserModel::getUserId($pseudo);

        $receiver = ConversationModel::getOtherUsers($id_sender, $id_conv);

        $public_key = UserModel::getUserPublicKey($receiver[0]['pseudo']);

        openssl_public_encrypt($contenu, $crypted_message, $public_key);
        
        /*message en BDD*/
        $data = ConversationModel::addMessage($crypted_message, $pseudo, $id_conv);
        $data = array(0);


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