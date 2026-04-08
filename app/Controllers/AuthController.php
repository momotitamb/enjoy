<?php

class AuthController extends Controller {


    public function loginForm() {
        $this->render('auth/login');
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->findByEmail($email);

        if ((!$user) || (!password_verify($password, $user['password']))) {
            header('Location: /login');
            exit();
        }

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        header('Location: /');
        exit();
    }

    public function registerForm() {
        $this->render('auth/register');
    }

    public function register() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            header('Location: /register');
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        (new User())->create($name, $email, $hashed_password);

        header('Location: /login');
        exit();
    }

    public function logout() {
        session_start();
        session_destroy();

        header('Location: /login');
        exit();
    }
}