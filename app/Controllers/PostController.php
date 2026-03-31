<?php

class PostController extends Controller {

    public function index() {
        $post = new PostRepository();
        $posts = $post->getAll();
        $this->render('posts/index', ['posts' => $posts]);
    }    

    public function show($id) {
        $post = (new PostRepository())->findById($id);
        $this->render('posts/show', ['post' => $post]);
    }

    public function create() {
        $this->render('posts/create');
    }

    public function store() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        (new PostRepository())->create(['title' => $title, 'slug' => $slug, 'content' => $content]);
        header('Location: /');
        exit();
    }

    public function edit($id) {
        $post = (new PostRepository())->findById($id);
        $this->render('posts/edit', ['post' => $post]);
    }

    public function update($id) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        (new PostRepository())->update($id, ['title' => $title, 'slug' => $slug, 'content' => $content]);
        header('Location: /');
        exit();
    }

    public function destroy($id) {
        (new PostRepository())->delete($id);
        header('Location: /');
        exit();
    }
    
}