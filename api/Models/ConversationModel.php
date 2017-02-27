<?php

require_once('../../Database.php');

class ConversationModel{
    
    public static function add_message($contenu, $id_user, $id_conv){
        $bdlink = Database::connexionBDD();

        $sql = $bdlink->prepare("INSERT INTO message (`contenu`, `date`, `id_user`, `id_conversation`) VALUES (:contenu, now(), :user, :conv);");
        $sql->execute(array(':contenu' => $contenu, ':user' => $id_user, ':conv' => $id_conv));
    }

    /*cette fonction renvoie un tableau contenant les messages classés du + récent au + ancient */
    public static function get_all_messages_of_conv($id_conv){
        $bdlink = Database::connexionBDD();
        $result = [];
        $i = 0;

        $sql = $bdlink->prepare("SELECT `contenu`, `id_user` FROM `message` WHERE `id_conversation` = :conv ORDER BY `date`DESC;");
        $sql->execute(array(':conv' => $id_conv));
        
        $result = $sql->fetchAll();
        
        /*var_dump($result);*/
        
        return $result;
    }

    /*fonction cherchant les x dernier messages d'une conversation*/

    public static function get_new_messages_of_conv(){
        /*
            chercher si le dernier message connu est égal au nombre de messages de la conv
            date du dernier message == date dernier message connu ?
            message connu ?
        */
    }
    
    /*true = conv exist / false conv n'existe pas*/
    public static function conv_exist($conv_name){
        $bdlink = Database::connexionBDD();
	
        $sql = $bdlink->prepare("SELECT `ID` FROM `conversation` WHERE `conversation_name` = :name");
        $sql->execute(array(':name' => $conv_name));

        if($sql->rowcount()){
            return true;
        } else {
            return false;
        }
    }

    /*la fonction prend en paramètre un tableau des pseudos sous forme de chaines de caractères*/
    public static function create_conv($pseudo_array){
        /*array size*/
        /*si 1 SEUL pseudo => erreur */
        /*créer une string avec les pseudos*/
        $conv_name = $pseudo_array[0];
        
        for($i = 1; $i < count($pseudo_array); $i++){
            $conv_name = $conv_name.", ".$pseudo_array[$i];
        }
        
        echo $conv_name."</br>";
        
        /*faire une fonction qui regarde si une conv entre pseudo entrés existe déjà
        à appeler ici*/
        $test_conv = ConversationModel::conv_exist($conv_name);
        
        var_dump($test_conv);
        
        /*ajouter string dans table*/
        /*$bdlink = Database::connexionBDD();
        $sql = $bdlink->prepare("INSERT INTO `conversation`(`ID`) VALUES (NULL);");
        $sql->execute();*/

        /*aller chercher la dernière conv grace à la string (unique car vérifié au dessus)*/
        
        /*faire for taille pseudo_array ajouter ligne dans user_conv avec id conv ligne précédente*/
        
        /*nb de ligne = id de la dernière ligne ajoutée*/
        /*result = SELECT COUNT(*) FROM `conversation`;*/
    }

    public static function get_conv_of_user(){

        /*ID des conv de ce user*/
        /*SELECT `id_conversation` FROM `user_conversation` WHERE `id_user` = 5*/
        /*utiliser l'id pour afficher la liste du nom des conv*/
    }
}

?>