<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\AddCommentCommand;
use App\Domain\Entity\Comment;
use App\Domain\Repository\CommentRepositoryInterface;
use App\Domain\Repository\PostRepositoryInterface;

class AddCommentUseCase
{
    public function __construct(
        private CommentRepositoryInterface $commentRepository,
        private PostRepositoryInterface $postRepository
    ) {}

    public function execute(AddCommentCommand $command): string
    {
        $post = $this->postRepository->findById($command->postId);
        if (!$post) {
            throw new \InvalidArgumentException("Post not found with ID: {$command->postId}");
        }

        $comment = new Comment(
            $command->id,
            $command->postId,
            $command->author,
            $command->content
        );

        $comment->setPost($post);
        $post->addComment($comment);

        $this->commentRepository->save($comment);
        $this->postRepository->save($post);

        return $comment->getId();
    }
}