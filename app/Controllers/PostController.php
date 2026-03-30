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
        echo '';
    }

    public function store() {
        echo '';
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