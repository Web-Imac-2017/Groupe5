<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class ConversationModel{
    
    public static function addMessage($contenu, $pseudo, $id_conv){
        $bdd = Database::connexionBDD();
        
        $id_user = UserModel::getUserId($pseudo);
        
        $req_active = $bdd->prepare("INSERT INTO message (`contenu`, `date`, `id_user`, `id_conversation`) VALUES (:contenu, now(), :user, :conv); ");
        $bdd->beginTransaction();
        $req_active->bindParam(':contenu', $contenu, PDO::PARAM_STR);
        $req_active->bindParam(':user', $id_user, PDO::PARAM_INT);
        $req_active->bindParam(':conv', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
        $result = $bdd->lastInsertId();
        $bdd->commit();
        
        return intval($result);
    }

    /*cette fonction renvoie un tableau contenant les messages classés du + récent au + ancient */
    public static function getAllMessagesOfConv($id_conv){
        $bdd = Database::connexionBDD();
        $result = [];

        $req_active = $bdd->prepare("SELECT `id_user`, `date`, `ID`, `contenu` as `content` FROM `message` WHERE `id_conversation` = :conv ORDER BY `date` ASC;");
        $req_active->bindParam(':conv', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
        
        $result = $req_active->fetchAll();

        for($i=0; $i < count($result); $i++){
            $num_id = intval($result[$i]['id_user']);
            $result[$i]['user'] = UserModel::getPseudoById($num_id);
            
            /*Décryptage des messages*/
            $result[$i]['content'] = ConversationModel::decryptMessage($result[$i]['user'], $result[$i]['content']);
        }
       
        return $result;
    }
    
    public static function getNewMessagesOfConv($id_last_message, $id_conv){
        $bdd = Database::connexionBDD();
        $result = [];
        $req_active = $bdd->prepare("SELECT `id_user`, `date`, `ID`, `contenu` as `content` FROM `message` WHERE `id_conversation` = :conv && `ID` > :last_message ORDER BY `date` DESC;");
        $req_active->bindParam(':conv', $id_conv, PDO::PARAM_INT);
        $req_active->bindParam(':last_message', $id_conv, PDO::PARAM_INT);        
        $req_active->execute();
        
        $result = $req_active->fetchAll();
        
        for($i=0; $i < count($result); $i++){
            $num_id = intval($result[$i]['id_user']);
            $result[$i]['user'] = UserModel::getPseudoById($num_id);
            
            /*Décryptage des messages*/
            $result[$i]['content'] = ConversationModel::decryptMessage($result[$i]['user'], $result[$i]['content']);
        }
        
        return $result;
    }
    
    /*retourne une string*/
    public static function getLastMessageOfConv($id_conv){
        $bdd = Database::connexionBDD();
        $result = [];

        $req_active = $bdd->prepare("SELECT `contenu`, `id_user` FROM `message` WHERE `id_conversation` = :conv ORDER BY `date` DESC LIMIT 1;");
        $req_active->bindParam(':conv', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
        
        $result = $req_active->fetch(PDO::FETCH_ASSOC);
        
        /*Décryptage des messages*/
        $pseudo = UserModel::getPseudoById($result['id_user']);
        $result['contenu'] = ConversationModel::decryptMessage($pseudo, $result['contenu']);
        
        return $result['contenu'];
    }

    /*la fonction prend en paramètre un tableau des pseudos sous forme de chaines de caractères*/
    public static function createConv($pseudo_array){
        $user = [];
        
        for($i = 0; $i < count($pseudo_array); $i++){
            array_push($user, UserModel::getUserId($pseudo_array[$i]));
        }

        /*ajoute ligne dans conversation*/
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare("INSERT INTO `conversation`(`ID`, `titre`) VALUES (NULL, NULL);");
        $bdd->beginTransaction();
        $req_active->execute();
        $id_conv = $bdd->lastInsertId();
        $bdd->commit();

        if($id_conv){
            /*rempli user_conv*/
            for($i = 0; $i < count($pseudo_array); $i++){
                $req_active = $bdd->prepare("INSERT INTO `user_conversation`(`id_user_conversation`, `id_conversation`, `id_user`) VALUES (NULL, :conv, :user)");
                $req_active->bindParam(':conv', $id_conv, PDO::PARAM_INT);
                $req_active->bindParam(':user', $user[$i][0], PDO::PARAM_INT);
                $req_active->execute();
            }

        }else{
            echo "problème d'insertion de ligne dans la table ocnv";
        }
    }
    
    /*retourne un tableau*/
    public static function getConvOfUser($pseudo){
        $id_user = UserModel::getUserId($pseudo);
        $result = [];
        
        $bdd = Database::connexionBDD();
        $req_active = $bdd->prepare("SELECT `ID` as `id`
        FROM conversation
        INNER JOIN user_conversation
        WHERE conversation.`id` = user_conversation.`id_conversation` && user_conversation.`id_user` = :user ;");
        $req_active->bindParam(':user', $id_user[0], PDO::PARAM_INT);
        $req_active->execute();
        
        $result = $req_active->fetchAll();
        
        for($i=0; $i < count($result); $i++){
            /*last message*/
            $result[$i]['lastMessage'] = ConversationModel::getLastMessageOfConv($result[$i]['id']);
            
            $result[$i]['users'] = ConversationModel::getOtherUsers($id_user[0], $result[$i]['id']);
        }
        
        return $result;
    }
    
    public static function getOtherUsers($id_user, $id_conv){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare("SELECT `pseudo`, `avatar`
        FROM user
        INNER JOIN user_conversation
        WHERE user.`ID` = user_conversation.`id_user` && user_conversation.`id_user` != :user && user_conversation.`id_conversation` = :id_conv ;");
        $req_active->bindParam(':user', $id_user, PDO::PARAM_INT);
        $req_active->bindParam(':id_conv', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
        
        return $req_active->fetchAll();
    }
    
    public static function decryptMessage($pseudo, $crypted){
        
        $key = file_get_contents('../../Security/key/'.$pseudo.'.txt');
        openssl_private_decrypt($crypted, $decrypted, $key);
        
        return $decrypted;
    }
    
    public static function deleteConversation($id_conv){
        $bdd = Database::connexionBDD();
        
        /* DATA IN USER_CONVERSATION */
        $req_active = $bdd->prepare("DELETE FROM `user_conversation` WHERE `id_conversation` = :id");
        $req_active->bindParam(':id', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
        
        /* DATA IN MESSAGE */
        $req_active = $bdd->prepare("DELETE FROM `message` WHERE `id_conversation` = :id");
        $req_active->bindParam(':id', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
        
        /* DATA IN CONVERSATION */
        $req_active = $bdd->prepare("DELETE FROM `conversation` WHERE `ID` = :id");
        $req_active->bindParam(':id', $id_conv, PDO::PARAM_INT);
        $req_active->execute();
    }
}

?>