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
            $query = self::$connection->query($string);
            if (is_bool($query)) {
                switch ($query) {
                    case true:
                        self::$result = true;
                        break;
                    case false:
                        self::$result = self::$connection->error;
                        break;
                }
            } else {
                if ($query->num_rows > 0) {
                    self::$result = $query->fetch_all();
                } else self::$result = false;
            }
        } else {
            self::connect();
            self::query($string);
        }
    }
    public static function getResult() {
        return self::$result;
    }
}