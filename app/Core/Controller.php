<?php

abstract class Controller {
    public function render($view, $data = []) {
        extract($data);
        require __DIR__ . "/../../views/{$view}.php";
    }

    public function auth() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }
}