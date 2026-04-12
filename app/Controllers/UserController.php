<?php

class UserController extends Controller {

    public function index() {
        $this->auth();
        $users = (new User())->all();
        $this->render('users/index', ['users' => $users]);
    }

    public function show($id) {
        $this->auth();
        $user = (new User())->find($id);
        $this->render('users/show', ['user' => $user]);
    }    

    public function edit($id) {
        $this->adminOnly();
        $user = (new User())->find($id);
        $this->render('users/edit', ['user' => $user]);
    }

    public function update($id) {
        $this->adminOnly();
        
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }

        $validator = new Validator($_POST);
        $validator->required('name')->required('email')->email('email');

        if ($validator->fails()) {
            $this->setFlash('error', implode(', ', $validator->errors()));
            header('Location: /users');
            exit();
        }

        $name = $_POST['name'];
        $email = $_POST['email'];

        (new User())->update($name, $email, $id);
        $this->setFlash('success', 'Пользователь успешно обновлен!');

        header('Location: /users');
        exit();
    }
    
    public function destroy($id) {
        $this->adminOnly();
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }

        (new User())->delete($id);
        $this->setFlash('success', 'Пользователь удален');

        header('Location: /users');
        exit();
    }    
}