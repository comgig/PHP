<?php
namespace COMGIG;

Class Cryptographic {

    private static $key = "Random String Key";

    public static function encrypt($string){
        $payload = rtrim(strtr(base64_encode(random_int(1000, 9999).'$'.$string.'$'.random_int(100, 999)), '+/', '-_'), '=');
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($payload, 'aes-256-cbc', base64_encode(self::$key), 0, $iv);
        return base64_encode($encrypted . ':*:' . $iv);
    }

    public static function decrypt($string){
        list($encrypted_data, $iv) = explode(':*:', base64_decode($string), 2);
        $payload = openssl_decrypt($encrypted_data, 'aes-256-cbc', base64_encode(self::$key), 0, $iv);
        return explode("$", base64_decode(str_pad(strtr($payload, '-_', '+/'), strlen($payload) % 4, '=', STR_PAD_RIGHT)))[1];
    }

    
}