<?php

require_once('../../Database.php');
require_once('../../Models/UserModel.php');

class NotificationModel{
    
    public static function addNotif($id_notif, $pseudo1, $pseudo2){ /*pseudo 1 = emetteur, pseudo 2 = recepteur*/
        $bdd = Database::connexionBDD();
        
        $id_user1 = UserModel::getUserId($pseudo1);
        $id_user2 = UserModel::getUserId($pseudo2);

        $req_active = $bdd->prepare("INSERT INTO `user_notification` (`ID`, `ID_user1`, `ID_user2`, `date`, `id_notification`) VALUES (NULL, :user1, :user2, NOW(), :id_notif )");
        $req_active->execute(array(':id_notif' => $id_notif, ':user1' => $id_user1, ':user2' => $id_user2));
    }

    /*cette fonction renvoie un tableau contenant les notifications classés du + récent au + ancient */
    public static function getAllNotif($pseudo){
        $bdd = Database::connexionBDD();
        $result = [];

        $id_user = UserModel::getUserId($pseudo);
        $req_active = $bdd->prepare('SELECT user_notification.ID, `ID_user1`, `date`, notification.contenu_notification as `content` FROM `user_notification`, `notification` WHERE `ID_user2` = :id_user AND notification.ID = user_notification.id_notification ORDER BY `date` ASC');
        $req_active->execute(array( ':id_user' => $id_user));
        $result = $req_active->fetchAll(PDO::FETCH_ASSOC);


        for($i=0; $i < count($result); $i++){
            $num_id = intval($result[$i]['ID_user1']);
            $result[$i]['user'] = UserModel::getPseudoById($num_id);
        }
       
        return $result;
    }
    
    public static function deleteNotif($idNotif){
        $bdd = Database::connexionBDD();

        $req_active = $bdd->prepare('DELETE FROM user_notification WHERE ID = :id_notif');
        $req_active->execute(array(":id_notif" => $idNotif));
    }
}  
 
?>