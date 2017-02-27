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

    /*Mettre à jour le nom de l'utilisateur*/
    public static function updateUserLastname($pseudo, $userLastname){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET nom = '.$userLastname.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    /*Mettre à jour le prénom de l'utilisateur*/
    public static function updateUserName($pseudo, $userName){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET prenom = '.$userName.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    /*Mettre à jour le mot de passe de l'utilisateur*/
    public static function updateUserPassword($pseudo, $userPassword){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET password = '.MD5($userPassword).' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    /*Mettre à jour le mail de l'utilisateur*/
    public static function updateUserMail($pseudo, $userMail){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET email = '.$userMail.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    /*Mettre à jour la description de l'utilisateur*/
    public static function updateUserDescription($pseudo, $userDescription){
        $bdd = Database::connexionBDD();
        
        $req_active = $bdd->prepare('UPDATE user SET description = '.$userDescription.' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    /*Ajouter un hobby à l'utilisateur*/
    public static function setUserHobbies($pseudo, $nameHobby){
        $idUser = UserModel::getUserId();

        $req_idHobby = $bdd->prepare('SELECT ID FROM centre_interet WHERE Nom = "'.$nameHobby.'"');
        $req_idHobby->execute();
        $id_Hobby = $req_idHobby->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('INSERT INTO user_centre_interet (ID, id_interet, id_user) VALUES ('','.$idHobby['ID'].','.idUser.')');
        $req_active->execute();
    }

    /*Supprimer un hobby à l'utilisateur*/
    public static function deleteUserHobbies($pseudo, $nameHobby){
        $idUser = UserModel::getUserId();

        $req_idHobby = $bdd->prepare('SELECT ID FROM centre_interet WHERE Nom = "'.$nameHobby.'"');
        $req_idHobby->execute();
        $id_Hobby = $req_idHobby->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('DELETE FROM user_centre_interet WHERE id_interet = '.$id_Hobby.' AND id_user = "'.$idUser.'"');
        $req_active->execute();
    }

    /*Ajouter une langue à l'utilisateur*/
    public static function setUserLang($pseudo, $nameLang, $master){
        $idUser = UserModel::getUserId();

        $req_idLang = $bdd->prepare('SELECT ID FROM langue WHERE Nom = "'.$nameLang.'"');
        $req_idLang->execute();
        $id_lang = $req_idLang->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('INSERT INTO user_langue (ID, id_user, id_langue, maitrise) VALUES ('','.idUser.','.$idLang['ID'].','.$master.')');
        $req_active->execute();
    }

    /*Enlever une langue à l'utilisateur*/
    public static function deleteUserLang($pseudo, $nameLang){
        $idUser = UserModel::getUserId();

        $req_idLang = $bdd->prepare('SELECT ID FROM langue WHERE Nom = "'.$nameLang.'"');
        $req_idLang->execute();
        $id_lang = $req_idLang->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('DELETE FROM user_langue WHERE id_langue = '.$id_lang.' AND id_user = "'.$idUser.'"');
        $req_active->execute();
    }

    /*Modifier le pays de l'utilisateur*/
    public static function updateUserPays($pseudo, $namePays){
        $idUser = UserModel::getUserId();

        $req_idPays = $bdd->prepare('SELECT id_pays FROM table_pays WHERE fr = '.$namePays.'"');
        $req_idPays->execute();
        $id_pays = $req_idPays->fetch(PDO::FETCH_ASSOC);

        $req_active = $bdd->prepare('UPDATE user SET id_pays = '.$id_pays['id_pays'].' WHERE pseudo = "'.$pseudo.'"');
        $req_active->execute();
    }

    
    public static function userResearch($searched) { //La variable $searched est ce que l'utilisateur a entré dans le champ de recherche
        $bdd = Database::connexionBDD();
        // On cherche tous les pseudos contenant la suite de caractères entrée
        $searchResults = $bdd->prepare('SELECT pseudo FROM user WHERE pseudo LIKE "%'.$searched.'%"');
        $searchResults->execute();

        if($searchResults->fetch()){
            $result = $searchResults->fetch();
        }
        else {
            $result = array("Error", "Error: We can't find what you searched");
        }
        
        return $result;
    }



    /*Récupère les langues maitrisées (2) par un utilisateur*/
    public static function getUserLangueMaitrisee($pseuso) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);


        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_langue FROM user, user_langue, langue WHERE user_langue.maitrise = "2" AND user.ID=user_langue.id_user AND user.ID='.$idUser' ');
            $req_id->execute();
            $idLangueMaitrisee = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idLangueMaitrisee['id_langue']);
        }
        else $result = array(0);

        return $result;
    }

    /*Récupère les langues à apprendre (1) par un utilisateur*/
    public static function getUserLangueAApprendre($pseudo) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);

        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_langue FROM user, user_langue, langue WHERE user_langue.maitrise = "1" AND user_langue.id_langue='.$idUser.'');
            $req_id->execute();
            $idLangueAApprendre = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idLangueAApprendre['id_langue']);
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
            $req_id = $bdd->prepare('SELECT DISTINCT id_user, pseudo FROM user, user_langue, langue WHERE user_langue.maitrise=2 AND user_langue.id_langue='.$idLangue.' AND user.ID=user_langue.id_user ');
            $req_id->execute();
            $idUserMaitre = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idUserMaitre['id_user']);
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
            $req_id = $bdd->prepare('SELECT DISTINCT id_user FROM user, user_langue, langue WHERE user_langue.maitrise=1 AND user_langue.id_langue='.$idLangue.' AND user.ID=user_langue.id_user ');
            $req_id->execute();

            $idUserApprenti = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idUserApprenti['id_user']);
        }
        else $result = array(0);

        return $result;
    }

    /*Récupère les centres d'interet d'un utilisateur*/
    public static function getUserCentreInteret($pseuso) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);


        session_start();
        if(isset($_SESSION['login'])) {
            $idUser = getUserId();
            $req_id = $bdd->prepare('SELECT DISTINCT id_interet FROM user, user_centre_interet, centre_interet WHERE user_centre_interet.id_user ='.$idUser.'');
            $req_id->execute();
            $idCentreInteret = $req_id->fetch(PDO::FETCH_ASSOC);

            $result = array($idCentreInteret['id_interet']);
        }
        else $result = array(0);

        return $result;
    }

    public static function getUserMatch($pseuso) {
        $bdd = Database::connexionBDD();

        $idUser = getUserId($pseudo);
        $idCentreInteret = getUserCentreInteret($idUser);

        if($idCentreInteret != NULL){
            session_start();
            if(isset($_SESSION['login'])) {
                $arret=0;
                do {
                    $req_id = $bdd->prepare('SELECT DISTINCT id_user, id_interet FROM user, user_centre_interet, centre_interet WHERE user_centre_interet.id_interet ='.$idCentreInteret['id_interet'][$i].'');
                    $req_id->execute();
                    $idUserCentreInteret = $req_id->fetch(PDO::FETCH_ASSOC);

                    $result = array($idUserCentreInteret['id_interet'], $idUserCentreInteret['id_interet']);
                    $arret++;
                }while(($idCentreInteret['id_interet'] != NULL) || ($arret < 10));
            }
            else $result = array(0);
        }

        return $result;
    }

    
    /* Création du profil (première connexion) */
    public static function setUserProfil($nom, $prenom, $pseudo, $email, $password, $date_inscription, $last_connection, $description, $pays, $id_etat_activ) {
        $bdd = Database::connexionBDD();
        
        /* Recherche si le pseudo existe :*/
        $req_pseudo = $bdd->prepare('SELECT ID FROM user WHERE pseudo = '.$pseudo);
        $req_pseudo->execute();
        
        if($donnees = $req_pseudo->fetch(PDO::FETCH_ASSOC)){
            $result = array("Error", "Error: Pseudo already taken");
        }
        
        else{
            /* Recherche si le mail deja used :*/
            $req_mail = $bdd->prepare('SELECT email FROM user WHERE pseudo = '.$pseudo);
            $req_mail->execute();
            if($donnees = $req_mail->fetch(PDO::FETCH_ASSOC)){
                $result = array("Error", "Error: mail already taken.");
            }
            else{
                $req_idPays = $bdd->prepare('SELECT id_pays FROM table_pays WHERE fr = '.$pays);
                $req_idPays->execute();
                $id_pays = $req_idPays->fetch(PDO::FETCH_ASSOC);

                $req_active = $bdd->prepare('INSERT INTO user (ID, nom, prenom, pseudo, email, password, date_inscription, derniere_connexion, description, id_pays, id_etat_activite) VALUES ('.$nom.', '.$prenom.', '.$pseudo.', '.$email.', '.$password.', '.$date_inscription ', '.$last_connection.', '.$description.', '.$id_pays['id_pays'].', '.$id_etat_activ.')');
                $req_active->execute(); 
                $result = array(0);
            }
        }
        return $result;
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

    