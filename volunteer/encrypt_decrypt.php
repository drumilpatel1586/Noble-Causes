<?php

// Encrypt a string using AES encryption
function encrypt_string($key, $plaintext) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $ciphertext);
}

// Decrypt a string using AES encryption
function decrypt_string($key, $encrypted) {
    $data = base64_decode($encrypted);
    $iv_size = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $iv_size);
    $ciphertext = substr($data, $iv_size);
    return openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}

// Encrypt a number using AES encryption
function encrypt_number($key, $number) {
    return encrypt_string($key, strval($number));
}

// Decrypt a number using AES encryption
function decrypt_number($key, $encrypted) {
    return intval(decrypt_string($key, $encrypted));
}
// for( $i = 1; $i < 20; $i++ ){

// $e_i = encrypt_number(32,$i);
// echo $e_i;
// $d_i = decrypt_number(32,$e_i);
// echo $d_i;
// echo '<br>';
// }

