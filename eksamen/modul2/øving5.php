<?php
function encryptText($plaintext, $key) {
    $cipher = "AES-256-CBC"; // algoritme
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen); // tilfeldig IV
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, 0, $iv);
    // lagre både IV og tekst sammen (base64)
    return base64_encode($iv . $ciphertext);
}

function decryptText($ciphertext_base64, $key) {
    $cipher = "AES-256-CBC";
    $ivlen = openssl_cipher_iv_length($cipher);
    $ciphertext_dec = base64_decode($ciphertext_base64);
    // del opp: først IV, så selve kryptert tekst
    $iv = substr($ciphertext_dec, 0, $ivlen);
    $ciphertext = substr($ciphertext_dec, $ivlen);
    return openssl_decrypt($ciphertext, $cipher, $key, 0, $iv);
}

// Eksempelbruk
$key = "hemmeligNøkkel123"; // nøkkelen må være hemmelig
$original = "Hei Oda, dette er en test!";

$encrypted = encryptText($original, $key);
echo "Kryptert: " . $encrypted . "<br>";

$decrypted = decryptText($encrypted, $key);
echo "Dekryptert: " . $decrypted . "<br>";
?>