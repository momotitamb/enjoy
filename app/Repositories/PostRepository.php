<?php

class PostRepository implements PostRepositoryInterface {
    public function getAll(): array {
        return (new Post())->all();
    }

    public function findById(int $id): array {
        return (new Post())->find($id);
    }

    public function create(array $data): void {
        (new Post())->create($data['title'], $data['slug'], $data['content']);
    }

    public function update(int $id, array $data): void {
        (new Post())->update($data['title'], $data['slug'], $data['content'], $id);
    }

    public function delete(int $id): void {
        (new Post())->delete($id);
    }

    public function findBySlug(string $slug): array {
        return (new Post())->findBySlug($slug);
        
    }
}