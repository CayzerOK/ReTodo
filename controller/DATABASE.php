<?php

class DATABASE {
    static private $connection = false;
    static private $result;

    public function __construct() {
        self::connect();
    }

    static function connect() {
        $config = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config/mysql.json'), true);
        self::$connection = new mysqli($config['target'], $config['user'], $config['password'], $config['basename']) or die('Не удалось соединиться: ' . mysql_error());
    }

    static function query($string) {
        if (self::$connection) {
            self::$result = self::$connection->query($string) or die("Не удалось создать таблицу: (" . self::$connection->errno . ") " . self::$connection->error);
        } else {
            self::connect();
            self::query($string);
        }
    }
    public static function getResult() {
        return self::$result;
    }
}