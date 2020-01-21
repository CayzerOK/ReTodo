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
        $this->valid($login, $password);
        try {
            $salt = random_int(10000000, 99999999);
        } catch (Exception $e) {
            die($e);
        }
        $passhash = password_hash(substr($salt, 0, 3) . $password . substr($salt, 4, 8), PASSWORD_BCRYPT);
        $this->initBase();
        DATABASE::query("INSERT INTO users (uuid, salt, username, passhach) values ('" . $_SESSION['uuid'] . "', " . $salt . ", '" . $login . "', '" . $passhash . "')");
        echo json_encode(DATABASE::getResult());
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
        if ($result) {
            if (password_verify(substr($result[0][1], 0, 3) . $password . substr($result[0][1], 4, 8), $result[0][3])) {
                $_SESSION['uuid'] = $result[0][0];
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
                                  `uuid` VARCHAR(36) NOT NULL UNIQUE,
                                  `salt` INT(8) NOT NULL,
                                  `username` varchar(30) NOT NULL UNIQUE,
                                  `passhach` varchar(255) NOT NULL,
                                  `admin` BOOLEAN NOT NULL DEFAULT FALSE)');
    }
}