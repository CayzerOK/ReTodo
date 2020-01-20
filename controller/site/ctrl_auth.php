<?php


class ctrl_auth {
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
        DATABASE::query("INSERT INTO users (uuid, salt, username, passhach) values ('" . $_SESSION['uuid'] . "', " . $salt . ", '" . $login . "', '" . $passhash . "')");
        echo json_encode(DATABASE::getResult());
    }
    public function login() {
        DATABASE::query("INSERT INTO users (uuid, salt, username, passhach) values ('" . $_SESSION['uuid'] . "', " . $salt . ", '" . $login . "', '" . $passhash . "')");
    }
    public function logout() {
        session_destroy();
    }

    public function getSession() {
        echo json_encode($_SESSION);
    }

    function initBase() {
        DATABASE::query('CREATE TABLE IF NOT EXISTS `users` (
                                  `uuid` VARCHAR(36) NOT NULL UNIQUE,
                                  `salt` INT(8) NOT NULL,
                                  `username` varchar(30) NOT NULL UNIQUE,
                                  `passhach` varchar(255) NOT NULL)');
    }
}