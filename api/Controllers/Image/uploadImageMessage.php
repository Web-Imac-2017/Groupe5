<?php 
    session_start();

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header('Content-Type: application/json;charset=utf-8');

	include "../../Models/ImageModel.php";

    //$json = json_decode(file_get_contents('php://input'), true);
    $pseudo = $_POST['pseudo'];
    $id_conv = $_POST['id_conv'];
    $date = date("Y-m-d-h-i-s");
    $result = array();

    $maxsize = 10000000;
    $avatarExp = '#^image/(png|jpeg|gif)$#i';
    $width = 350;
    $height = 350;

    if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
        
        if ($_FILES['avatar']['error'] > 0){
            $result = array("Error", "Image can't be register.");
            if($_FILES['avatar']['size'] > $maxsize){
                $result = array("Error", "It's too big.");
            }
        } 
        else{
            //Check si le fichier correspond bien à une image :
            $image_infos = getimagesize($_FILES['avatar']['tmp_name']);
            $verif_format = preg_match($avatarExp, $image_infos['mime'], $tab);

            echo $_FILES['avatar']['tmp_name'];

            if($image_infos[0] > 0 && $image_infos[1] > 0 && !empty($tab[1]) && $verif_format) {

                // Traitement de l'image :
                echo "Le type de l'image est ".$tab[1];
                $createImage = 'imagecreatefrom'.$tab[1];
                $copy = $createImage($_FILES['avatar']['tmp_name']);

                // Cacul des nouvelles dimensions

                $ratio_orig = $image_infos[0]/$image_infos[1];

                if ($width/$height > $ratio_orig) {
                   $width = $height*$ratio_orig;
                } else {
                   $height = $width/$ratio_orig;
                }

                //Creer un nouvelle image pour gérer le format :
                $newImage = imagecreatetruecolor($width, $height);
                imagecopyresampled($newImage, $copy, 0, 0, 0, 0, $width, $height, $image_infos[0], $image_infos[1]);
                //Déplace l'image dans le repertoire 
                imagepng($newImage, "C:/wamp/www/WebS4/Plume/static/messages/".$pseudo."_".$id_conv."_".$date.".png");
                $result = ImageModel::uploadImageMessage("/static/messages/".$pseudo."_".$id_conv."_".$date.".png", $pseudo, $id_conv);
            }
            else {
                $result = array("Error", "Image can't be register.");
                echo $result;
            }
        }
    }

?>