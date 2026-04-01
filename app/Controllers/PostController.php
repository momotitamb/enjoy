<?php

class PostController extends Controller {
    private RepositoryInterface $repo;

    public function __construct(RepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $posts = $this->repo->getAll();
        $this->render('posts/index', ['posts' => $posts]);
    }    

    public function show($id) {
        $post = $this->repo->findById($id);
        $this->render('posts/show', ['post' => $post]);
    }

    public function create() {
        $this->render('posts/create');
    }

    public function store() {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        $this->repo->create(['title' => $title, 'slug' => $slug, 'content' => $content]);
        header('Location: /');
        exit();
    }

    public function edit($id) {
        $post = $this->repo->findById($id);
        $this->render('posts/edit', ['post' => $post]);
    }

    public function update($id) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        $this->repo->update($id, ['title' => $title, 'slug' => $slug, 'content' => $content]);
        header('Location: /');
        exit();
    }

    public function destroy($id) {
        $this->repo->delete($id);
        header('Location: /');
        exit();
    }
    
}