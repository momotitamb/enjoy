<?php


class Database {
    private static $instance;

    private function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        self::$instance = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
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