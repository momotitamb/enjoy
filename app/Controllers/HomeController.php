<?php

class HomeController extends Controller {
private PostRepositoryInterface $repo;

    public function __construct(PostRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function index(): void {
        $posts = $this->repo->getAll();
        $this->render('posts/index', ['posts' => $posts]);
    }    
    
}