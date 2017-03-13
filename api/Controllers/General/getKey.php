<?php

include "../../Models/UserModel.php";
set_include_path("../../Security/");

require_once "Crypt/RSA.php";

$rsa = new Crypt_RSA();

extract($rsa->createKey());

$plaintext = 'Bonjour';

openssl_public_encrypt($plaintext, $crypttext, $publickey);

var_dump($publickey);
var_dump($privatekey);

//echo "encoding".mb_detect_encoding($crypttext);

//echo "Crypt text:<br>".$crypttext."<BR><BR>";

file_put_contents('../../Security/key/test.txt', $crypttext);

/*openssl_private_decrypt($crypttext, $decrypted, $privatekey);

echo "Decrypted text:<BR>$decrypted<br><br>";*/

//UserModel::updateUserPublicKey($publickey, 'Fabricetea');

/*echo $string;*/

//$result = file_put_contents('../../Security/key/Fabricetea.txt', $privatekey);

/*$test = file_get_contents('../../Security/key/Fabricetea.txt');

/*var_dump($test);*/

openssl_private_decrypt($crypttext, $decrypted, $privatekey);
echo "Decrypted text:<BR>$decrypted<br><br>";

?>