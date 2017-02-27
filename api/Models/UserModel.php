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
<<<<<<< HEAD

    public static function updateUserLastname($pseudo, $userLastname){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET nom = '.$userLastname.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    public static function updateUserName($pseudo, $userName){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET prenom = '.$userName.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    public static function updateUserPassword($pseudo, $userPassword){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET password = '.MD5($userPassword).' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    public static function updateUserMail($pseudo, $userMail){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET email = '.$userMail.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    public static function updateUserDescription($pseudo, $userDescription){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET description = '.$userDescription.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    public static function setUserHobbies($pseudo, $nameHobby){
        $idUser = UserModel::getUserId();

        $req_idHobby = $bdd->prepare('SELECT ID FROM centre_interet WHERE Nom = "'.$nameHobby.'"');
        $req_idHobby->execute();
        $id_Hobby = $req_idHobby->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('INSERT INTO user_centre_interet (ID, id_interet, id_user) VALUES ('','.$idHobby['ID'].','.idUser.')');
        $req_active->execute();
    }

    public static function deleteUserHobbies($pseudo, $nameHobby){
        $idUser = UserModel::getUserId();

        $req_idHobby = $bdd->prepare('SELECT ID FROM centre_interet WHERE Nom = "'.$nameHobby.'"');
        $req_idHobby->execute();
        $id_Hobby = $req_idHobby->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('DELETE FROM user_centre_interet WHERE id_interet = '.$id_Hobby.' AND id_user = "'.$idUser.'"');
        $req_active->execute();
    }

    public static function setUserLang($pseudo, $nameLang, $master){
        $idUser = UserModel::getUserId();

        $req_idLang = $bdd->prepare('SELECT ID FROM langue WHERE Nom = "'.$nameLang.'"');
        $req_idLang->execute();
        $id_lang = $req_idLang->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('INSERT INTO user_langue (ID, id_user, id_langue, maitrise) VALUES ('','.idUser.','.$idLang['ID'].','.$master.')');
        $req_active->execute();
    }

    public static function deleteUserLang($pseudo, $nameLang){
        $idUser = UserModel::getUserId();

        $req_idLang = $bdd->prepare('SELECT ID FROM langue WHERE Nom = "'.$nameLang.'"');
        $req_idLang->execute();
        $id_lang = $req_idLang->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('DELETE FROM user_langue WHERE id_langue = '.$id_lang.' AND id_user = "'.$idUser.'"');
        $req_active->execute();
    }

    public static function updateUserPays($pseudo, $namePays){
        $idUser = UserModel::getUserId();

        $req_idPays = $bdd->prepare('SELECT id_pays FROM table_pays WHERE fr = '.$namePays.'"');
        $req_idPays->execute();
        $id_pays = $req_idPays->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('UPDATE user SET id_pays = '.$id_pays['id_pays'].' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }


=======
    
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
    
    public static function getUserHobbies($pseudo) {
        $bdd = Database::connexionBDD();
        $user_id = getUserId($pseudo);
        $donnees = array();
        i = 0;
        
        /* Recuperer les id des hobbies du user */
        $req_active = $bdd->prepare('SELECT id_interet FROM user_centre_interet WHERE id_user = '.$user_id);
        $req_active->execute();
        
        /*$result = $req_active->fetch(PDO::FETCH_ASSOC);*/
        /*$id_hobbies = array($result['id_interet']);*/
        
        /* Renvoyer les noms des hobbies du user */
        while($result = $req_active->fetch(PDO::FETCH_ASSOC)){
            $hobbies = getHobbies($result['id_interet']);
            $donnees[i] = $hobbies;
            i++;
            }
        return $donnees;
    }
    
    public static function getUserDateInscription($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT date_inscription FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_inscription = $req_active->fetch(PDO::FETCH_ASSOC);
            $result = array($user_inscription['date_inscription']);
        }
        else $result = array(0);
        
        return $result;        
    }
    
    public static function getUserMail($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT email FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_mail = $req_active->fetch(PDO::FETCH_ASSOC);
            $result = array($user_mail['email']);
        }
        else $result = array(0);
        
        return $result;   
    }
    
    public static function getUserLastConnexion($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT derniere_connexion FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_lastConnect = $req_active->fetch(PDO::FETCH_ASSOC);
            $result = array($user_lastConnect['derniere_connexion']);
        }
        else $result = array(0);
        
        return $result;  
    }
    
    public static function getUserPays($pseudo) {
        $bdd = Database::connexionBDD();
        $id = getUserId($pseudo);
        
        /* Recupere l'ID du pays dans la table user */
        if($id !== 0){
            $req_active = $bdd->prepare('SELECT id_pays FROM user WHERE ID ='.$id);
            $req_active->execute();
            $user_pays = $req_active->fetch(PDO::FETCH_ASSOC);
            $idPays = array($user_pays['id_pays']);
            
            /* Recuperation du nom dans la table Pays */
            $req_nomPays = $bdd->prepare('SELECT fr FROM table_pays WHERE id_pays = '.$idPays['id_pays']);
            $req_nomPays->execute();
            $nom_pays = $req_nomPays->fetch(PDO::FETCH_ASSOC);
            $result = array($nom_pays['fr']);
        }
        else $result = array(0);

        return $result;  
    }
    
>>>>>>> f7b6ad7819df1cbe9f19e1f1fd704448d8689e3d
}

?>