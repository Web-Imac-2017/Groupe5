<?php

include "../../Models/UserModel.php";
set_include_path("../../Security/");

require_once "Crypt/RSA.php";

$rsa = new Crypt_RSA();

extract($rsa->createKey());

$plaintext = 'Bonjour';

openssl_public_encrypt($plaintext, $crypttext, $publickey);

echo "Crypt text:<br>$crypttext<BR><BR>";

/*openssl_private_decrypt($crypttext, $decrypted, $privatekey);

echo "Decrypted text:<BR>$decrypted<br><br>";*/

UserModel::updateUserPublicKey($publickey, 'Fabricetea');

/*echo $string;*/

$result = file_put_contents('../../Security/key/Fabricetea.txt', $privatekey);

$test = file_get_contents('../../Security/key/Fabricetea.txt');

/*var_dump($test);*/

openssl_private_decrypt($crypttext, $decrypted, $test);

echo "Decrypted text:<BR>$decrypted<br><br>";

?>