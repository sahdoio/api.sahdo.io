<?php

declare(strict_types=1);

namespace App\Application\DTO;

use DateTimeImmutable;

class CreatePostCommand
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $content,
        public readonly string $slug,
        public readonly DateTimeImmutable $publishedAt
    ) {}
}