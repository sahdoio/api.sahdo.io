<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\GetPostQuery;
use App\Domain\Entity\Post;
use App\Domain\Repository\PostRepositoryInterface;

class GetPostUseCase
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {}

    public function execute(GetPostQuery $query): ?Post
    {
        if ($query->slug) {
            return $this->postRepository->findBySlug($query->slug);
        }

        if ($query->id) {
            return $this->postRepository->findById($query->id);
        }

        throw new \InvalidArgumentException("Either id or slug must be provided");
    }
}