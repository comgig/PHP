<?php
namespace COMGIG;
use \mysqli;
use \DateTime;

Class Database {
    public static function connect(){
        $connection=null;
        try{
            $db_host = 'localhost';
            $db_user = 'root';
            $db_pass = '1234';

            date_default_timezone_set("Asia/Bangkok"); // Initial web-Server TimeZone
            $now = new DateTime();
            $mins = $now->getOffset() / 60;
            $sgn = ($mins < 0 ? -1 : 1);
            $mins = abs($mins);
            $hrs = floor($mins / 60);
            $mins -= $hrs * 60;
            $offset = sprintf('%+d:%02d', $hrs*$sgn, $mins); // set offset to sync with mySql server

            $connection = new mysqli($db_host,$db_user,$db_pass);
            $connection->set_charset("utf8");
            $connection->query("SET time_zone='$offset';");  // Sync Server Time to mySql server time
        }catch(\Throwable $error) {
            exit("Connection failed : ".$error->getMessage());
        }
        return $connection;
    }
}