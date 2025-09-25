<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeImmutable;

class Comment
{
    private string $id;
    private string $postId;
    private string $author;
    private string $content;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private Post $post;

    public function __construct(
        string $id,
        string $postId,
        string $author,
        string $content
    ) {
        $this->id = $id;
        $this->postId = $postId;
        $this->author = $author;
        $this->content = $content;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function updateContent(string $content): void
    {
        $this->content = $content;
        $this->updatedAt = new DateTimeImmutable();
    }
}