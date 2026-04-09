<?php

abstract class Controller {
    public function render($view, $data = []) {
        extract($data);
        require __DIR__ . "/../../views/{$view}.php";
    }

    public function auth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }

    public function adminOnly() {
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: /');
            exit();
        }
    }
}