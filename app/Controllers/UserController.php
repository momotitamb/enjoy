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
        $name = $_POST['name'];
        $email = $_POST['email'];

        (new User())->update($name, $email, $id);

        header('Location: /');
        exit();
    }
    
    public function destroy($id) {
        $this->adminOnly();
        (new User())->delete($id);
        header('Location: /');
        exit();
    }    
}