<?php

class MYSQL {
    private $connection;
    static function connect() {
        file_get_contents($_SERVER['DOCUMENT_ROOT'].'/config/mysql.json');
    }
}