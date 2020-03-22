<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('hash_password')){
    function hash_password($password)
    {
        $ci =& get_instance();
        $key = $ci->config->item('encryption_key');
        $salt1 = hash('sha512', $key . $password);
        $salt2 = hash('sha512', $password . $key);
        $hashed_password = hash('sha512', $salt1 . $password . $salt2);
    
        return $hashed_password;
    }
}

if(!function_exists('encrypt')){
    function encrypt($string_to_encrypt) {
        $ci =& get_instance();
        $key = $ci->config->item('encryption_key');
        $encrypted_string = openssl_encrypt($string_to_encrypt,"AES-128-ECB",$key);
        return $encrypted_string;
    }
}

if(!function_exists('decrypt')){
    function decrypt($encrypted_string) {
        $ci =& get_instance();
        $key = $ci->config->item('encryption_key');
        $decrypted_string = openssl_decrypt($encrypted_string,"AES-128-ECB",$key);
        return $decrypted_string;
    }
}