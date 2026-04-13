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

        $validator = new Validator($_POST);
        $validator->required('email')->required('password')->email('email');

        if ($validator->fails()) {
            $this->setFlash('error', implode(', ', $validator->errors()));
            header('Location: /login');
            exit();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->findByEmail($email);

        if ((!$user) || (!password_verify($password, $user['password']))) {
            $this->setFlash('error', 'Неверный email или пароль');
            header('Location: /login');
            exit();
        }

        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        $this->setFlash('success', 'Успешный вход');

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
        $_SESSION['old'] = ['name' => $name, 'email' => $email];

        $validator = new Validator($_POST);
        $validator->required('name')->required('email')->required('password')->required('confirm_password')
            ->minLength('password', 4)->minLength('confirm_password', 4)->email('email');

        if ($validator->fails()) {
            $this->setFlash('error', implode(', ', $validator->errors()));
            header('Location: /register');
            exit();
        }


        if ($password !== $confirm_password) {
            $this->setFlash('error', 'Пароли не совпадают');
            header('Location: /register');
            exit();
        }

        $user = (new User())->findByEmail($email);
        if ($user) {
            $this->setFlash('error', 'Email уже занят');
            header('Location: /register');
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        (new User())->create($name, $email, $hashed_password);
        
        $user = (new User())->findByEmail($email);
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        unset($_SESSION['old']);

        $this->setFlash('success', 'Пользователь успешно зарегистрирован');

        header('Location: /');
        exit();
    }

    public function logout() {
        session_destroy();

        header('Location: /login');
        exit();
    }
}