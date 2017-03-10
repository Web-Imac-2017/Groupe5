<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class NotificationModel{
    
    public static function addNotification($contenu, $pseudo1, $pseudo2){ /*pseudo 1 = emetteur, pseudo 2 = recepteur*/
        $bdd = Database::connexionBDD();
        
        $id_user1 = UserModel::getUserId($pseudo1);
        $id_user2 = UserModel::getUserId($pseudo2);
        //var_dump($id_user2);
        $req_active = $bdd->prepare("INSERT INTO notification (`ID`, `ID_user1`, `ID_user2`,`contenu`, `date`) VALUES (NULL, :user1, :user2,:contenu, now())");
        $req_active->execute(array(':contenu' => $contenu, ':user1' => $id_user1, ':user2' => $id_user2));
    }

    /*cette fonction renvoie un tableau contenant les notifications classés du + récent au + ancient */
    public static function getAllNotif($pseudo){
        $bdd = Database::connexionBDD();
        $result = [];

        $id_user = UserModel::getUserId($pseudo);
        $req_active = $bdd->prepare('SELECT `ID`, `ID_user1`, `date`, `contenu` as `content` FROM `notification` WHERE `ID_user2` = '.$id_user.' ORDER BY `date` ASC');
        $req_active->execute();
        $result = $req_active->fetchAll();
        
        
        /*var_dump($result);*/

        for($i=0; $i < count($result); $i++){
            $num_id = intval($result[$i]['ID_user1']);
            $result[$i]['user'] = UserModel::getPseudoById($num_id);
        }
       
        return $result;
    }
    
    public static function deleteNotif($idNotif){
        $bdd = Database::connexionBDD();

        $req_active = $bdd->prepare('DELETE FROM notification WHERE ID = "'.$idNotif.'"');
        $req_active->execute();
    }
}  
 
?>