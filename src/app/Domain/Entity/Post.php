<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Post
{
    private string $id;
    private string $title;
    private string $content;
    private string $slug;
    private DateTimeImmutable $publishedAt;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;
    private Collection $comments;
    private Collection $likes;

    public function __construct(
        string $id,
        string $title,
        string $content,
        string $slug,
        DateTimeImmutable $publishedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->publishedAt = $publishedAt;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPublishedAt(): DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function updateContent(string $title, string $content, string $slug): void
    {
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }
    }

    public function addLike(Like $like): void
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
        }
    }

    public function removeLike(Like $like): void
    {
        $this->likes->removeElement($like);
    }

    public function getLikeCount(): int
    {
        return $this->likes->count();
    }
}