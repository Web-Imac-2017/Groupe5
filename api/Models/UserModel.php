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


}

?>