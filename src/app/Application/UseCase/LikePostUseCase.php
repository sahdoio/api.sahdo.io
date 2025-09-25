<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\LikePostCommand;
use App\Domain\Entity\Like;
use App\Domain\Repository\LikeRepositoryInterface;
use App\Domain\Repository\PostRepositoryInterface;

class LikePostUseCase
{
    public function __construct(
        private LikeRepositoryInterface $likeRepository,
        private PostRepositoryInterface $postRepository
    ) {}

    public function execute(LikePostCommand $command): string
    {
        $post = $this->postRepository->findById($command->postId);
        if (!$post) {
            throw new \InvalidArgumentException("Post not found with ID: {$command->postId}");
        }

        $existingLike = $this->likeRepository->findByPostIdAndUserId($command->postId, $command->userId);
        if ($existingLike) {
            throw new \InvalidArgumentException("User already liked this post");
        }

        $like = new Like(
            $command->id,
            $command->postId,
            $command->userId
        );

        $like->setPost($post);
        $post->addLike($like);

        $this->likeRepository->save($like);
        $this->postRepository->save($post);

        return $like->getId();
    }
}