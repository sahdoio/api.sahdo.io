<?php

declare(strict_types=1);

namespace App\Application\DTO;

class GetPostQuery
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $slug = null
    ) {}
}