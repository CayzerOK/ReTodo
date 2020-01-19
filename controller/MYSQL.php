<?php

class MYSQL {
    static private $connection = false;
    static public $result;

    public function __construct() {
        self::connect();
    }

    static function connect() {
        $config = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config/mysql.json'), true);
        self::$connection = mysqli_connect($config['target'], $config['user'], $config['password'], $config['basename']) or die('Не удалось соединиться: ' . mysql_error());
    }

    static function query($string) {
        if (self::$connection) {
            self::$result = mysql_query($string) or die('Неудачный запрос: ' . mysql_error());
            mysql_free_result(self::$result);
        } else {
            self::connect();
            self::query($string);
        }
    }
}