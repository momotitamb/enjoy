<?php

class Database {
    private static $instance;

    private function __construct() {
        self::$instance = new PDO(
            "mysql:host=localhost;dbname=cms", "root", ""
        );
    }

    static function getInstance() {
        if (self::$instance) {
            return self::$instance;
        } else {
            new self();
            return self::$instance;
        }
    }
}