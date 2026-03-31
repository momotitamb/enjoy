<?php


class Post {
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

    public function create($title, $slug, $content) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO posts (title, slug, content) VALUES (?, ?, ?)");
        $stmt->execute([$title, $slug, $content]);
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
}