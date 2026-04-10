<?php

interface PostRepositoryInterface {
    public function getAll(): array;
    public function findById(int $id): array|false;
    public function findBySlug(string $slug): array|false;
    public function create(array $data): void;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
    public function getAllWithCategory($page, $perPage): array;
}