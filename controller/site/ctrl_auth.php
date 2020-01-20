<?php


class ctrl_auth
{
    public function register() {

        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];

        if (strlen($login) < 6) {
            die('login');
        }
        if (strlen($login) < 6) {
            die('password');
        }
        try {
            $salt = random_int(10000000, 99999999);
        } catch (Exception $e) {
            die($e);
        }
        $passhash = password_hash(substr($salt, 0, 3) . $password . substr($salt, 4, 8), CRYPT_SHA256);
        $this->initBase();
        MYSQL::query('INSERT INTO users (uuid, salt, username, passhash) values (' . $_SESSION['uuid'] . ', ' . $salt . ', ' . $login . ', ' . $passhash . ')');
        print_r(MYSQL::getResult());
    }
    public function login($login, $password) {

    }
    public function logout() {
        session_destroy();
    }

    function initBase() {
        MYSQL::query('CREATE TABLE IF NOT EXISTS `users` (
                                  `id` BIGINT NOT NULL AUTO_INCREMENT,
                                  `uuid` BINARY NOT NULL,
                                  `salt` INT(8) NOT NULL,
                                  `username` varchar(30) NOT NULL,
                                  `passhach` varchar(255) NOT NULL,
                                  PRIMARY KEY (`uuid`))');
    }
}