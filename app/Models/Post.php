<?php


class Post extends Model {
    use TimestampableTrait;
    public const STATUS_DRAFT = 'draft';    
    public const STATUS_PUBLISHED = 'published';    

    public function all() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
        $stmt->execute();
        $posts = $stmt->fetchAll();
        return $posts;
    }

    public function find($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch();
        return $post;
    }

    public function findBySlug(string $slug) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ?");
        $stmt->execute([$slug]);
        $post = $stmt->fetch();
        return $post;
    }

    public function create($title, $slug, $content, $user_id, $category_id = null) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO posts (title, slug, content, status, category_id, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $content, self::STATUS_DRAFT, $category_id, $user_id]);
    }

    public function update($title, $slug, $content, $id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, slug = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $slug, $content, $id]);
    }

    public function delete($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getCategory($postId) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT 
            c.*
            FROM posts p
            JOIN categories c 
            ON p.category_id = c.id  
            WHERE p.id = ?
        ");
        $stmt->execute([$postId]);
        $category = $stmt->fetch();
        return $category;
    }

    public function getTableName(): string {
        return 'posts';
    }

    public function allWithCategory($page = 1, $perPage = 5) {
        $offset = ($page - 1) * $perPage;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT
            p.*,
            c.name AS category_name
            FROM posts p
            LEFT JOIN categories c 
            ON p.category_id = c.id
            ORDER BY p.id DESC
            LIMIT ? OFFSET ?
        ");
        // $stmt->execute([(int)$perPage, (int)$offset]);
        $stmt->bindValue(1, (int)$perPage, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll();
        return $posts;
    }

    public function allWithAuthor() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT
            posts.*,
            users.name AS author
            FROM posts
            LEFT JOIN users
            ON posts.user_id = users.id
        ");
        $stmt->execute();
        $posts = $stmt->fetchAll();
        return $posts;
    }

    public function allWithRelations() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT
            p.*,
            c.*,
            u.name AS author
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN users u ON p.user_id = u.id
        ");
        $stmt->execute();
        $posts = $stmt->fetchAll();
        return $posts;
    }

    public function count() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}