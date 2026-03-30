<?php


class Post {
    public function all() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        $posts = $stmt->fetchAll();
        return $posts;
    }
}