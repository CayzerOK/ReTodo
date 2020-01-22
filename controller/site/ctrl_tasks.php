<?php


class ctrl_tasks {

    function checked() {
        if (!$_SESSION['admin']) {
            die(json_encode([
                'done' => 'false'
            ]));
        }

        $id = $_REQUEST['id'];
        DATABASE::query("UPDATE tasks SET done = !done where id=$id");
        if(DATABASE::getResult()) {
            echo json_encode([
                'done' => 'true'
            ]);
        } else {
            echo json_encode([
                'done' => 'false'
            ]);
        }
    }

    function addTask() {
        $username = strip_tags($_REQUEST['user']);
        $email = strip_tags($_REQUEST['email']);
        $text = strip_tags($_REQUEST['text']);

        $this->initBase();

        DATABASE::query("INSERT INTO tasks (username, email, text) values ('$username', '$email', '$text')");

        if(DATABASE::getResult()) {
            echo json_encode([
                'done' => 'true'
            ]);
        } else {
            echo json_encode([
                'done' => 'false'
            ]);
        }
    }

    function editTask() {
        if (!$_SESSION['admin']) {
            die(json_encode([
                'done' => 'false'
            ]));
        }

        $id = $_REQUEST['id'];
        $value = $_REQUEST['value'].'(ред.)';

        DATABASE::query("UPDATE tasks SET text = '$value' where id=$id");
        if(DATABASE::getResult()) {
            echo json_encode([
                'done' => 'true'
            ]);
        } else {
            echo json_encode([
                'done' => 'false'
            ]);
        }
    }

    function getTasks() {
        $page = $_REQUEST['page'];
        $sort = $_REQUEST['sort'];
        $desc = $_REQUEST['desc'];

        if($desc==='true') {
            $desc = 'DESC';
        } else {
            $desc = '';
        }

        $this->initBase();

        $start = ($page-1)*3;

        DATABASE::query("SELECT * FROM tasks ORDER BY $sort ".$desc);
        $result = DATABASE::getResult();

        if(is_array($result)) {
            TMP::add('tasks', array_slice($result, $start,3));
        } else {
            echo $result;
        }


    }

    function initBase() {
        DATABASE::query('CREATE TABLE IF NOT EXISTS `tasks` (
                                  `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                  `username` VARCHAR(36) NOT NULL,
                                  `email` VARCHAR(50) NOT NULL,
                                  `text` varchar(255) NOT NULL,
                                  `done` BOOLEAN NOT NULL DEFAULT FALSE)');

        if(!DATABASE::getResult()) {
            die('DATABASE INIT FAILED');
        }
    }
}