<?php

class AuthController extends Controller {


    public function loginForm() {
        $this->render('auth/login');
    }

    public function login() {
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->findByEmail($email);

        if ((!$user) || (!password_verify($password, $user['password']))) {
            header('Location: /login');
            exit();
        }

        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        header('Location: /');
        exit();
    }

    public function registerForm() {
        $this->render('auth/register');
    }

    public function register() {
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }

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
        session_destroy();

        header('Location: /login');
        exit();
    }
}