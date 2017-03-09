<?php

include "../../Models/UserModel.php";
set_include_path("../../Security/");

require_once "Crypt/RSA.php";

define("OPENSSL_CONF", '../../Security/openssl.cnf');

$rsa = new Crypt_RSA();

extract($rsa->createKey());

/*echo $privatekey . '<br/>' . $publickey;*/

//$rsa->loadKey('...'); // private

$plaintext = 'Bonjour';

openssl_public_encrypt($plaintext, $crypttext, $publickey);

echo "Crypt text:<br>$crypttext<BR><BR>";

openssl_private_decrypt($crypttext, $decrypted, $privatekey);

echo "Decrypted text:<BR>$decrypted<br><br>";

UserModel::updateUserPublicKey($publickey, 'Fabricetea');

$result = openssl_pkey_export_to_file ( $privatekey , 'private.txt' );

var_dump($result);

?>