<?php

declare(strict_types=1);

namespace App\Application\DTO;

class LikePostCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $postId,
        public readonly string $userId
    ) {}
}