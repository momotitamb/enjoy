<?php

class CategoryController extends Controller {
    use LoggableTrait;

    private Category $category;
    

    public function __construct() {
        $this->category = new Category();
    }

    public function index(): void {
        $categories = $this->category->all();
        $this->render('categories/index', ['categories' => $categories]);
    }    

    public function create() {
        $this->adminOnly();
        $this->render('categories/create');
    }

    public function store() {
        $this->adminOnly();
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }

        $name = $_POST['name'];
        $slug = strtolower(str_replace(' ', '-', $name));

        $this->category->create($name, $slug);
        $this->log('Category created');

        header('Location: /categories');
        exit();
    }
    
    public function destroy($id) {
        $this->adminOnly();
        if (!$this->verifyCsrfToken()) {
            header('Location: /');
            exit();
        }
        $this->category->delete($id);
        
        header('Location: /categories');
        exit();
    }    
}