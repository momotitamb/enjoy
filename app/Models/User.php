<?php

class User extends Model {
    use TimestampableTrait;

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    public function getTableName(): string {   
        return 'users';
    }

    public function  all() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    public function find($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user;
    }

    public function create($name, $email) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
    }

    public function delete($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getPostsCount() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT
            users.*,
            COUNT(posts.id) AS posts_count
            FROM users
            LEFT JOIN posts ON users.id = posts.user_id
            GROUP BY users.id
        ");
        $stmt->execute();
        $posts_count = $stmt->fetchAll();
        return $posts_count;
    }
}