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

    /*Récupère les langues maitrisées (2) par un utilisateur*/
    public static function getUserLangueMaitrise($pseuso) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);


        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_langue FROM user, user_langue, langue WHERE user_langue.maitrise = "2" AND user.ID=user_langue.id_user AND user.ID='.$idUser' ');
            $req_id->execute();
            $idUser = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idLangueMaitrise['id_langue_maitrise']);
        }
        else $result = array(0);

        return $result;
    }

    /*Récupère les langues à apprendre (1) par un utilisateur*/
    public static function getUserLangueApprendre($pseudo) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);

        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_user FROM user, user_langue, langue WHERE user_langue.maitrise = "1" AND user_langue.id_langue='.$idUser.'');
            $req_id->execute();
            $idUser = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idLangueMaitrise['id_langue_apprendre']);
        }
        else $result = array(0);

        return $result;
    }

    /*Récupère les possibles "Maitres" pour une langue donnée*/
    public static function findMaitre($pseudo, $idLangue) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);

        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_user FROM user, user_langue, langue WHERE user_langue.maitrise = "2" AND user_langue.id_langue='.$idLangue.'');
            $req_id->execute();
            $idUser = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idUserMaitrise['id_user_maitre']);
        }
        else $result = array(0);

        return $result;
    }

    /*Récupère les possibles "Apprentis" pour une langue donnée*/
    public static function findApprenti($pseudo, $idLangue) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);

        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_user FROM user, user_langue, langue WHERE user_langue.maitrise = "1" AND user_langue.id_langue='.$idLangue.'');
            $req_id->execute();
            $idUser = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idLangueMaitrise['id_user_apprendre']);
        }
        else $result = array(0);

        return $result;
    }



}

?>