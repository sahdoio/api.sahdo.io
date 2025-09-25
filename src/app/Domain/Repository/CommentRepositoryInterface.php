<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Comment;

interface CommentRepositoryInterface
{
    public function save(Comment $comment): void;

    public function findById(string $id): ?Comment;

    /** @return Comment[] */
    public function findByPostId(string $postId): array;

    public function delete(Comment $comment): void;
}