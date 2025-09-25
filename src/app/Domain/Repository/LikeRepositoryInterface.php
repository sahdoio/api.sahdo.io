<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Like;

interface LikeRepositoryInterface
{
    public function save(Like $like): void;

    public function findById(string $id): ?Like;

    public function findByPostIdAndUserId(string $postId, string $userId): ?Like;

    /** @return Like[] */
    public function findByPostId(string $postId): array;

    public function delete(Like $like): void;

    public function countByPostId(string $postId): int;
}