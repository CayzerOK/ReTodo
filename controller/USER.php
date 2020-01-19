<?php


class USER {
    public $admin;
    public $nickname;
    public $UUID;
    public function __construct() {
        if (!empty($token)) {
            MYSQL::query('CREATE TABLE IF NOT EXISTS `users` (
                                  `id` BIGINT NOT NULL AUTO_INCREMENT,
                                  `uuid` BINARY NOT NULL,
                                  `username` varchar(30) NOT NULL,
                                  `passhach` varchar(255) NOT NULL,
                                  `lastact` datetime NOT NULL DEFAULT NOW(),
                                  PRIMARY KEY (`uuid`))');
            MYSQL::query('SELECT * FORM users WHERE ');
        } else {

            $this->admin = false;
            $this->nickname = "Гость";
            $this->UUID = uniqid('reTodo', true);

            session_start([
                'uuid'=>$this->UUID,
                'nickname'=>$this->nickname,
            ]);
        }
    }
}