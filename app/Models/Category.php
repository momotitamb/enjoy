<?php

class Category extends Model implements Sluggable {
    use TimestampableTrait;
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public function generateSlug(string $text): string {
        return strtolower(str_replace(' ', '-', $text));
    }

    public function getTableName(): string {   
        return 'categories';
    }

    public function  all() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }

    public function find($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch();
        return $post;
    }

    public function create($name, $slug) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
        $stmt->execute([$name, $slug]);
    }

    public function delete($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }
}