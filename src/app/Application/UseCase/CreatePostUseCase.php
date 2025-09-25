<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\CreatePostCommand;
use App\Domain\Entity\Post;
use App\Domain\Repository\PostRepositoryInterface;

class CreatePostUseCase
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {}

    public function execute(CreatePostCommand $command): string
    {
        if ($this->postRepository->existsBySlug($command->slug)) {
            throw new \InvalidArgumentException("A post with slug '{$command->slug}' already exists");
        }

        $post = new Post(
            $command->id,
            $command->title,
            $command->content,
            $command->slug,
            $command->publishedAt
        );

        $this->postRepository->save($post);

        return $post->getId();
    }
}