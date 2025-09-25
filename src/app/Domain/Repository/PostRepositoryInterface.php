<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Post;

interface PostRepositoryInterface
{
    public function save(Post $post): void;

    public function findById(string $id): ?Post;

    public function findBySlug(string $slug): ?Post;

    /** @return Post[] */
    public function findAll(): array;

    /** @return Post[] */
    public function findPublished(int $limit = 10, int $offset = 0): array;

    public function delete(Post $post): void;

    public function existsBySlug(string $slug): bool;
}