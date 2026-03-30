<?php

class HomeController extends Controller {

    public function index() {
        $post = new Post();
        $posts = $post->all();
        $this->render('home', ['posts' => $posts]);
    }    
    
}