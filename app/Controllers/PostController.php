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
        if ($post === false) {
            header('Location: /');
            exit();
        }
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
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }

        $validator = new Validator($_POST);
        $validator->required('title')->required('content')->minLength('title', 2)->minLength('content', 7);

        if ($validator->fails()) {
            $this->setFlash('error', implode(', ', $validator->errors()));
            header('Location: /');
            exit();
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];
        $user_id = $_SESSION['user_id'];
        $slug = strtolower(str_replace(' ', '-', $title));

        $this->repo->create(['title' => $title, 'slug' => $slug, 'content' => $content, 
            'category_id' => $category_id, 'user_id' => $user_id]);
        $this->setFlash('success', 'Пост создан!');
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
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }

        $validator = new Validator($_POST);
        $validator->required('title')->required('content')->minLength('title', 2)->minLength('content', 7);

        if ($validator->fails()) {
            $this->setFlash('error', implode(', ', $validator->errors()));
            header('Location: /');
            exit();
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = strtolower(str_replace(' ', '-', $title));

        $this->repo->update($id, ['title' => $title, 'slug' => $slug, 'content' => $content]);
        $this->setFlash('success', 'Пост обновлен!');

        header('Location: /');
        exit();
    }

    public function destroy($id) {
        $this->auth();
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }
        $this->repo->delete($id);
        $this->setFlash('success', 'Пост удален!');

        header('Location: /');
        exit();
    }    
}