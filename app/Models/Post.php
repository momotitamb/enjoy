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

    public function create($title, $slug, $content) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO posts (title, slug, content, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $content, self::STATUS_DRAFT]);
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
}