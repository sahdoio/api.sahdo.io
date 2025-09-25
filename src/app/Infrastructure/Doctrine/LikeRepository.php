<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Entity\Like;
use App\Domain\Repository\LikeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class LikeRepository implements LikeRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        $this->repository = $entityManager->getRepository(Like::class);
    }

    public function save(Like $like): void
    {
        $this->entityManager->persist($like);
        $this->entityManager->flush();
    }

    public function findById(string $id): ?Like
    {
        return $this->repository->find($id);
    }

    public function findByPostIdAndUserId(string $postId, string $userId): ?Like
    {
        return $this->repository->findOneBy([
            'postId' => $postId,
            'userId' => $userId
        ]);
    }

    public function findByPostId(string $postId): array
    {
        return $this->repository->findBy(['postId' => $postId]);
    }

    public function delete(Like $like): void
    {
        $this->entityManager->remove($like);
        $this->entityManager->flush();
    }

    public function countByPostId(string $postId): int
    {
        return $this->repository->createQueryBuilder('l')
            ->select('COUNT(l.id)')
            ->where('l.postId = :postId')
            ->setParameter('postId', $postId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}