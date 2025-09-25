<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Entity\Comment;
use App\Domain\Repository\CommentRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CommentRepository implements CommentRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        $this->repository = $entityManager->getRepository(Comment::class);
    }

    public function save(Comment $comment): void
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    public function findById(string $id): ?Comment
    {
        return $this->repository->find($id);
    }

    public function findByPostId(string $postId): array
    {
        return $this->repository->findBy(['postId' => $postId], ['createdAt' => 'ASC']);
    }

    public function delete(Comment $comment): void
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }
}