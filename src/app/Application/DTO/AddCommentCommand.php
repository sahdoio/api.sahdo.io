<?php

declare(strict_types=1);

namespace App\Application\DTO;

class AddCommentCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $postId,
        public readonly string $author,
        public readonly string $content
    ) {}
}