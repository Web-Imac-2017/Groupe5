<?php

require_once(__DIR__.'/../Database.php');

class UserModel
{
   public static function login($pseudo, $password) {
        $bdd = Database::connexionBDD();
        
        $req_ident = $bdd->prepare('SELECT pseudo FROM user WHERE pseudo = "'.$pseudo.'"');
        $req_ident->execute();

        if($req_ident->fetch()){
            $req_password = $bdd->prepare('SELECT password FROM user WHERE pseudo = "'.$pseudo.'"');
            $req_password->execute();
            $recup_password = $req_password->fetch();
            $password_hach = md5($password);
                    
            if($password_hach == $recup_password["password"]){
                UserModel::setUserState($pseudo, 1);

                $req_id = $bdd->prepare('SELECT ID FROM user WHERE pseudo = "'.$pseudo.'"');
                $req_id->execute();
                $idUser = $req_id->fetch(PDO::FETCH_ASSOC);

                $result = array($idUser['ID'], $pseudo);

                UserModel::initUserSession($pseudo);
            }
            else {
                $result = array("Error", "Error: the password isn't correct.");
            }
        }
        else {
            $result = array("Error", "Error: the pseudo doesn't exist.");
        }
        
        return $result;
    }

    public static function setUserState($pseudo, $userState) {
        $bdd = Database::connexionBDD();
       
        $req_active = $bdd->prepare('UPDATE user SET id_etat_activite = '.$userState.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    public static function initUserSession($pseudo) {
        session_start();
        $_SESSION['login'] = $pseudo;
    }

    public static function logout($pseudo) {
        setUserState($pseudo, 0);
        UserModel::deleteUserSession();
    }

    public static function deleteUserSession() {
        session_destroy();
    }

    public static function getUserState() {
        $bdd = Database::connexionBDD();

        session_start();
        if(isset($_SESSION['login'])) {
            $req_id = $bdd->prepare('SELECT id_etat_activite FROM user WHERE pseudo = "'.$_SESSION['login'].'"');
            $req_id->execute();
            $idUser = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idUser['id_etat_activite']);
        }
        else $result = array(0);

        return $result;
    }
    
    /* Création du profil (première connexion) */
    public static function setUserProfil($nom, $prenom, $pseudo, $email, $password, $date_inscription, $last_connection, $description, $pays, $id_etat_activ) {
        $bdd = Database::connexionBDD();
        
        $req_idPays = $bdd->prepare('SELECT id_pays FROM table_pays WHERE fr = '.$pays);
        $req_idPays->execute();
        $id_pays = $req_idPays->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('INSERT INTO user (ID, nom, prenom, pseudo, email, password, date_inscription, derniere_connexion, description, id_pays, id_etat_activite) VALUES ('.$nom.', '.$prenom.', '.$pseudo.', '.$email.', '.$password.', '.$date_inscription ', '.$last_connection.', '.$description.', '.$id_pays['id_pays'].', '.$id_etat_activ.')');
        $req_active->execute();
    }
    
    public static function getUserId($pseudo) {
        $bdd = Database::connexionBDD();
        $req_active = $bdd->prepare('SELECT ID FROM user WHERE pseudo ='.$pseudo);
        $req_active->execute();
        
        if($id_user = $req_active->fetch(PDO::FETCH_ASSOC)){
            $result = array($id_user['id']);
        }
        else $result = array(0);
        
        return $result;
    }
    
    public static function getUserName($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT prenom FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_name = $req_active->fetch(PDO::FETCH_ASSOC);
            $result = array($user_name['prenom']);
        }
        else $result = array(0);
        
        return $result;
    }
    
    public static function getUserLastname($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT nom FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_lastname = $req_active->fetch(PDO::FETCH_ASSOC);
            $result = array($user_lastname['nom']);
        }
        else $result = array(0);
        
        return $result;  
    }
    
    public static function getUserDescription($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT description FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_desc = $req_active->fetch(PDO::FETCH_ASSOC);
            $result = array($user_desc['description']);
        }
        else $result = array(0);
        
        return $result;      
    }
    
    public static getHobbies($id_hobbies) {
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('SELECT Nom FROM centre_interet WHERE ID = '$id_hobbies);
        $req_active->execute();
        
        $hobbies = $req_active->fetch(PDO::FETCH_ASSOC);
        $result = array($hobbies['Nom']);
        
        return $result;
    }
    
   /* public static function getUserHobbies($pseudo) {
        $bdd = Database::connexionBDD();
        $user_id = getUserId($pseudo);*/
        
        /* Recuperer les id des hobbies du user */
       /* $req_active = $bdd->prepare('SELECT id_interet FROM user_centre_interet WHERE id_user = '.$user_id);
        $req_active->execute();*/
        
        /*$result = $req_active->fetch(PDO::FETCH_ASSOC);
        $id_hobbies = array($result['id_interet']);*/
        
        /* Renvoyer les noms des hobbies du user */
      /*  while($result = $req_active->fetch(PDO::FETCH_ASSOC)){
            $req_hobbies = $bdd->prepare('SELECT Nom FROM centre_interet WHERE ID ='.$req_hobbies);
            $req_hobbies->execute();
            while($data = $req_hobbies->fetch(PDO::FETCH_ASSOC)){
                /*$result = array($data['Nom']);*/
            /*}
            
        }
        
    }*/
    
}

?>