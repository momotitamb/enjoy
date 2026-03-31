<?php

class PostController extends Controller {

    public function index() {
        $post = new Post();
        $posts = $post->all();
        $this->render('posts/index', ['posts' => $posts]);
    }    

    public function show($id) {
        $post = (new Post())->find($id);
        $this->render('posts/show', ['post' => $post]);
    }

    public function create() {
        $this->render('posts/create');
    }

    public function store() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        (new Post())->create($title, $slug, $content);
        header('Location: /');
        exit();
    }

    public function edit($id) {
        $post = (new Post())->find($id);
        $this->render('posts/edit', ['post' => $post]);
    }

    public function update($id) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        (new Post())->update($title, $slug, $content, $id);
        header('Location: /');
        exit();
    }

    public function destroy($id) {
        (new Post())->delete($id);
        header('Location: /');
        exit();
    }
    
}