<?php
namespace COMGIG;

Class Validate {

    public static function username($string){
        return preg_replace('/[^a-z0-9]+/', '', strtolower(trim($string)));
    }

    public static function password($string){
        return hash('xxh128',trim($string));
    }

    public static function number($string){
        return preg_replace('/[^0-9]+/', '', trim($string));
    }

    public static function mobile($string){
        return preg_replace('/[^0-9]+/', '', trim($string));
    }

    public static function name($string){
        return preg_replace('/[^A-z0-9ก-๛]+/', '', trim($string));
    }

    public static function clean($data) {
        $data = preg_replace('/[^A-z0-9ก-๚ .@?_#*$+=%&()\/-]+/u', '', trim($data));
        return trim(preg_replace('/\s{2,}/u', ' ', trim($data)));
    }

    public static function cleanStrict($data) {
        $data = preg_replace('/[^A-z0-9ก-๚. -]+/u', '', trim($data));
        $data = trim(preg_replace('/\s{2,}/u', ' ', trim($data)));
        return trim(preg_replace('/\^/u', '', trim($data)));
    }


}