<?php

class PostController extends Controller {

    public function index() {
        $post = new Post();
        $posts = $post->all();
        $this->render('home', ['posts' => $posts]);
    }    

    public function show($id) {
        $post = (new Post())->find($id);
        $this->render('post', ['post' => $post]);
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

    public function edit() {
        echo '';
    }

    public function update() {
        echo '';
    }

    public function destroy() {
        echo '';
    }
    
}