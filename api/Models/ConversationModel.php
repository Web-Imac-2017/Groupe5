<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class ConversationModel{
    
    public static function addMessage($contenu, $pseudo, $id_conv){
        $bdd = Database::connexionBDD();
        
        $id_user = UserModel::getUserId($pseudo);
        
        $req_active = $bdd->prepare("INSERT INTO message (`contenu`, `date`, `id_user`, `id_conversation`) VALUES (:contenu, now(), :user, :conv);");
        $req_active->execute(array(':contenu' => $contenu, ':user' => $id_user, ':conv' => $id_conv));
    }

    /*cette fonction renvoie un tableau contenant les messages classés du + récent au + ancient */
    public static function getAllMessagesOfConv($id_conv){
        $bdd = Database::connexionBDD();
        $result = [];

        $req_active = $bdd->prepare("SELECT `contenu`, `id_user` FROM `message` WHERE `id_conversation` = :conv ORDER BY `date`DESC;");
        $req_active->execute(array(':conv' => $id_conv));
        
        $result = $req_active->fetchAll();
        
        /*var_dump($result);*/
        
        return $result;
    }
    
    public static function getNewMessagesOfConv($id_last_message, $id_conv){
        $bdd = Database::connexionBDD();
        $result = [];

        $req_active = $bdd->prepare("SELECT `contenu`, `id_user` FROM `message` WHERE `id_conversation` = :conv && `ID` > :last_message ORDER BY `date`DESC;");
        $req_active->execute(array(':conv' => $id_conv, ":last_message" => $id_last_message));
        
        $result = $req_active->fetchAll();
        
        /*var_dump($result);*/
        
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
    
    /*true = conv exist / false = conv n'existe pas*/
    public static function convExist($conv_name){
        $bdd = Database::connexionBDD();
	
        $req_active = $bdd->prepare("SELECT `ID` FROM `conversation` WHERE `conversation_name` = :name");
        $req_active->execute(array(':name' => $conv_name));

        if($req_active->rowcount()){
            return intval($req_active->fetchColumn());
        } else {
            return false;
        }
    }

    /*la fonction prend en paramètre un tableau des pseudos sous forme de chaines de caractères*/
    public static function createConv($pseudo_array){
        /*array size*/
        /*si 1 SEUL pseudo => erreur */
        /*créer une string avec les pseudos*/
        $conv_name = $pseudo_array[0];
        $user = [];
        
        $user[0] = UserModel::getUserId($pseudo_array[0]);
        
        for($i = 1; $i < count($pseudo_array); $i++){
            $conv_name = $conv_name.", ".$pseudo_array[$i];
            array_push($user, UserModel::getUserId($pseudo_array[$i]));
        }
        
        /*var_dump($user);
        echo $conv_name."</br>";*/
        
        /*faire une fonction qui regarde si une conv entre pseudo entrés existe déjà
        à appeler ici*/
        $test_conv = ConversationModel::convExist($conv_name);
        
        /*var_dump($test_conv);*/
        
        if(!$test_conv){
            /*ajouter string dans table*/
            $bdd = Database::connexionBDD();
            $req_active = $bdd->prepare("INSERT INTO `conversation`(`ID`, `conversation_name`) VALUES (NULL, :name);");
            $req_active->execute(array(':name' => $conv_name));

            /*aller chercher la dernière conv grace à la string*/
            $id_conv = ConversationModel::convExist($conv_name);
            
            /*var_dump($id_conv);*/
            
            if($id_conv){
                /*faire for taille pseudo_array ajouter ligne dans user_conv avec id conv ligne précédente*/
                for($i = 0; $i < count($pseudo_array); $i++){
                    $req_active = $bdd->prepare("INSERT INTO `user_conversation`(`id_user_conversation`, `id_conversation`, `id_user`) VALUES (NULL, :conv, :user)");
                    $req_active->execute(array(':conv' => $id_conv, ':user' => $user[$i][0]));
                }
                
            }else{
                echo "problème d'insertion de ligne dans la bdd";
            }
            
            
        }else{
            echo "conv existe déjà !";
        }
    }
    
    /*retourne un tableau*/
    public static function getConvOfUser($pseudo){
        $id_user = UserModel::getUserId($pseudo);
        $result = [];
        
        $bdd = Database::connexionBDD();
        $req_active = $bdd->prepare("SELECT `ID`
        FROM conversation
        INNER JOIN user_conversation
        WHERE conversation.`ID` = user_conversation.`id_conversation` && user_conversation.`id_user` = :user ;");
        $req_active->execute(array(':user' => $id_user[0]));
        
        $result = $req_active->fetchAll();
        
        for($i=0; $i < count($result); $i++){
            /*last message*/
            $result[$i]['lastMessage'] = ConversationModel::getLastMessageOfConv($result[$i]['ID']);
            
            /*pseudo of other users of conv*/
            $req_active = $bdd->prepare("SELECT `pseudo`
            FROM user
            INNER JOIN user_conversation
            WHERE user.`ID` = user_conversation.`id_user` && user_conversation.`id_user` != :user && user_conversation.`id_conversation` = :id_conv;");
            $req_active->execute(array(':user' => $id_user[0], ':id_conv' => $result[$i]['ID']));
            
            $result[$i]['users'] = $req_active->fetchAll();
            
            /*var_dump($result[$i]);*/
        }
        
        return $result;
    }
}

?>