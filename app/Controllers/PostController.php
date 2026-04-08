<?php

class PostController extends Controller {
    private PostRepositoryInterface $repo;
    use LoggableTrait;

    public function __construct(PostRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function index(): void {
        $page = $_GET['page'] ?? 1;
        $perPage = 5;
        $total = (new Post())->count();
        $totalPages = ceil($total / $perPage);
        $posts = $this->repo->getAllWithCategory($page, $perPage);
        $this->render('posts/index', ['posts' => $posts, 'totalPages' => $totalPages, 'page' => $page]);
    }    

    public function show($id) {
        $post = $this->repo->findById($id);
        $this->render('posts/show', ['post' => $post]);
    }

    public function showBySlug($slug) {
        $post = $this->repo->findBySlug($slug);
        $this->render('posts/slug', ['post' => $post]);
    }

    public function create() {
        $this->auth();
        $categories = (new Category())->all();
        $this->render('posts/create', ['categories' => $categories]);
    }

    public function store() { 
        $this->auth();     
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];
        $slug = strtolower(str_replace(' ', '-', $title));
        $this->repo->create(['title' => $title, 'slug' => $slug, 'content' => $content, 'category_id' => $category_id]);
        $this->log('Post created');
        header('Location: /');
        exit();
    }

    public function edit($id) {
        $this->auth();
        $post = $this->repo->findById($id);
        $this->render('posts/edit', ['post' => $post]);
    }

    public function update($id) {
        $this->auth();
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));
        $this->repo->update($id, ['title' => $title, 'slug' => $slug, 'content' => $content]);
        header('Location: /');
        exit();
    }

    public function destroy($id) {
        $this->auth();
        $this->repo->delete($id);
        header('Location: /');
        exit();
    }    
}