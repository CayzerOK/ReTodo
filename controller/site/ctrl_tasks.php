<?php


class ctrl_tasks {

    function addTask() {

    }

    function getTasks() {
        $page = $_REQUEST['page'];

        $this->initBase();

        $start = $page*3;

        DATABASE::query('SELECT * FROM tasks where id>');
    }

    function initBase() {
        DATABASE::query('CREATE TABLE IF NOT EXISTS `tasks` (
                                  `uuid` VARCHAR(36) NOT NULL UNIQUE,
                                  `email` INT(8) NOT NULL,
                                  `text` varchar(255) NOT NULL,
                                  `done` BOOLEAN NOT NULL DEFAULT FALSE)');

        if(!DATABASE::getResult()) {
            die('DATABASE INIT FAILED')
        }
    }
}