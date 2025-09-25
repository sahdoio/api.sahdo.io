<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeImmutable;

class Like
{
    private string $id;
    private string $postId;
    private string $userId;
    private DateTimeImmutable $createdAt;
    private Post $post;

    public function __construct(
        string $id,
        string $postId,
        string $userId
    ) {
        $this->id = $id;
        $this->postId = $postId;
        $this->userId = $userId;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}