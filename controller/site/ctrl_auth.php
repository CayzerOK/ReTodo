<?php


class ctrl_auth {
    public function valid($login, $password) {
        if (strlen($login) < 1) {
            die (json_encode([
                'done' => false,
                'info' => 'Incorrect Login'
            ]));
        }
        if (strlen($password) < 1) {
            die (json_encode([
                'done' => false,
                'info' => 'Incorrect Password'
            ]));
        }
    }
    public function register() {
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        $uuid = $_SESSION['uuid'];

        $this->valid($login, $password);
        $this->initBase();

        $passhash = hash('sha256',$password.$uuid);

        DATABASE::query("INSERT INTO users (uuid, username, passhach) values ('$uuid', '$login', '$passhash')");
        if (DATABASE::getResult()) {
            $_SESSION['uuid'] = $uuid;
            $_SESSION['username'] = $login;
            $_SESSION['guest'] = false;
            echo json_encode([
                'done' => true,
            ]);
        } else {
            echo json_encode([
                'done' => false,
                'info' =>'Вы уже вошли/зарегистрировались'
            ]);
        }
    }

    public function login_valid() {
        return $_SESSION['guest'];
    }
    public function login() {
        $login = $_REQUEST['login'];
        $password = $_REQUEST['password'];
        $this->valid($login,$password);

        DATABASE::query("SELECT * FROM users where username = '$login'");
        $result = DATABASE::getResult();
        if (is_array($result)) {
            if (hash('sha256',$password.$result[0][1]) === $result[0][3]) {
                $_SESSION['uuid'] = $result[0][1];
                $_SESSION['username'] = $result[0][2];
                $_SESSION['guest'] = false;
                $_SESSION['admin'] = $result[0][4];
                echo json_encode([
                    'done' => 'true'
                ]);
            } else {
                echo json_encode([
                    'done' => false,
                    'info' => 'Incorrect password'
                ]);
            }
        } else {
            echo json_encode([
                'done' => false,
                'info' =>'Incorrect login'
            ]);
        }
    }
    public function logout() {
        session_destroy();
    }

    public function getSession() {
        echo json_encode($_SESSION);
    }

    function initBase() {
        DATABASE::query('CREATE TABLE IF NOT EXISTS `users` (
                                  `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                  `uuid` VARCHAR(36) NOT NULL UNIQUE,
                                  `username` varchar(30) NOT NULL UNIQUE,
                                  `passhach` varchar(255) NOT NULL,
                                  `admin` BOOLEAN NOT NULL DEFAULT FALSE)');
    }
}