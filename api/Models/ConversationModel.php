<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class ConversationModel{
    
    public static function addMessage($contenu, $pseudo, $id_conv){
        $bdd = Database::connexionBDD();
        
        $id_user = UserModel::getUserId($pseudo);
        
        $req_active = $bdd->prepare("INSERT INTO message (`contenu`, `date`, `id_user`, `id_conversation`) VALUES (:contenu, now(), :user, :conv); ");
        $bdd->beginTransaction();
        $req_active->execute(array(':contenu' => $contenu, ':user' => $id_user, ':conv' => $id_conv));
        $result = $bdd->lastInsertId();
        $bdd->commit();
        
        return intval($result);
    }

    /*cette fonction renvoie un tableau contenant les messages classés du + récent au + ancient */
    public static function getAllMessagesOfConv($id_conv){
        $bdd = Database::connexionBDD();
        $result = [];

        $req_active = $bdd->prepare("SELECT `id_user`, `date`, `ID`, `contenu` as `content` FROM `message` WHERE `id_conversation` = :conv ORDER BY `date` ASC;");
        $req_active->execute(array(':conv' => $id_conv));
        
        $result = $req_active->fetchAll();
        
        /*var_dump($result);*/

        for($i=0; $i < count($result); $i++){
            $num_id = intval($result[$i]['id_user']);
            $result[$i]['user'] = UserModel::getPseudoById($num_id);
        }
       
        return $result;
    }
    
    public static function getNewMessagesOfConv($id_last_message, $id_conv){
        $bdd = Database::connexionBDD();
        $result = [];
        $req_active = $bdd->prepare("SELECT `id_user`, `date`, `ID`, `contenu` as `content` FROM `message` WHERE `id_conversation` = :conv && `ID` > :last_message ORDER BY `date` DESC;");
        
        $result = $req_active->fetchAll();
        
        /*var_dump($result);*/
        
        for($i=0; $i < count($result); $i++){
            $num_id = intval($result[$i]['id_user']);
            $result[$i]['user'] = UserModel::getPseudoById($num_id);
        }
        
        return $result;
    }
    
    /*retourne une string*/
    public static function getLastMessageOfConv($id_conv){
        $bdd = Database::connexionBDD();
        $result = [];

        $req_active = $bdd->prepare("SELECT `contenu` FROM `message` WHERE `id_conversation` = :conv ORDER BY `date` DESC LIMIT 1;");
        $req_active->execute(array(':conv' => $id_conv));
        
        $result = $req_active->fetchAll();
        
        /*var_dump($result);*/
        
        return $result[0]['contenu'];
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
                $req_active->execute(array(':conv' => $id_conv, ':user' => $user[$i][0]));
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
        $req_active->execute(array(':user' => $id_user[0]));
        
        $result = $req_active->fetchAll();
        
        for($i=0; $i < count($result); $i++){
            /*last message*/
            $result[$i]['lastMessage'] = ConversationModel::getLastMessageOfConv($result[$i]['id']);
            
            $result[$i]['users'] = ConversationModel::getOtherUsers($id_user[0], $result[$i]['id']);
            
            /*var_dump($result[$i]);*/
        }
        
        return $result;
    }
    
    public static function getOtherUsers($id_user, $id_conv){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare("SELECT `pseudo`
        FROM user
        INNER JOIN user_conversation
        WHERE user.`ID` = user_conversation.`id_user` && user_conversation.`id_user` != :user && user_conversation.`id_conversation` = :id_conv ;");
        $req_active->execute(array(':user' => $id_user, ':id_conv' => $id_conv));
        
        return $req_active->fetchAll();
    }
    
    public static function deleteConversation($id_conv){
        $bdd = Database::connexionBDD();
        
        /* DATA IN USER_CONVERSATION */
        $req_active = $bdd->prepare("DELETE FROM `user_conversation` WHERE `id_conversation` = :id");
        $req_active->execute(array(':id' => $id_conv));
        
        /* DATA IN MESSAGE */
        $req_active = $bdd->prepare("DELETE FROM `message` WHERE `id_conversation` = :id");
        $req_active->execute(array(':id' => $id_conv));
        
        /* DATA IN CONVERSATION */
        $req_active = $bdd->prepare("DELETE FROM `conversation` WHERE `ID` = :id");
        $req_active->execute(array(':id' => $id_conv));
    }
}

?>