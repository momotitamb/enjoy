<?php

interface PostRepositoryInterface {
    public function getAll(): array;
    public function findById(int $id): array;
    public function findBySlug(string $slug): array;
    public function create(array $data): void;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
}