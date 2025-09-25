<?php

declare(strict_types=1);

namespace App\Infrastructure\Web;

use App\Application\UseCase\CreatePostUseCase;
use App\Application\DTO\CreatePostCommand;
use App\Application\UseCase\GetPostUseCase;
use App\Application\DTO\GetPostQuery;
use App\Application\UseCase\AddCommentUseCase;
use App\Application\DTO\AddCommentCommand;
use App\Application\UseCase\LikePostUseCase;
use App\Application\DTO\LikePostCommand;
use DateTimeImmutable;
use Tempest\Http\GenericResponse;
use Tempest\Http\Request;
use Tempest\Http\Response;
use Tempest\Http\Status;
use Tempest\Router\Get;
use Tempest\Router\Post;

class BlogController
{
    public function __construct(
        private CreatePostUseCase $createPostUseCase,
        private GetPostUseCase    $getPostUseCase,
        private AddCommentUseCase $addCommentUseCase,
        private LikePostUseCase   $likePostUseCase
    ) {}

    #[Post('/posts')]
    public function createPost(Request $request): Response
    {
        $data = $request->body();

        $command = new CreatePostCommand(
            id: $data['id'] ?? uniqid(),
            title: $data['title'],
            content: $data['content'],
            slug: $data['slug'],
            publishedAt: isset($data['publishedAt'])
                ? new DateTimeImmutable($data['publishedAt'])
                : new DateTimeImmutable()
        );

        $id = $this->createPostUseCase->execute($command);

        return new GenericResponse(status: Status::CREATED, body: ['id' => $id]);
    }

    #[Get('/posts/{slug}')]
    public function getPostBySlug(string $slug): Response
    {
        $query = new GetPostQuery(slug: $slug);
        $post = $this->getPostUseCase->execute($query);

        if (!$post) {
            return new GenericResponse(status: Status::NOT_FOUND, body: ['error' => 'Post not found']);
        }

        return new GenericResponse(status: Status::OK, body: [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'slug' => $post->getSlug(),
            'publishedAt' => $post->getPublishedAt()->format('c'),
            'createdAt' => $post->getCreatedAt()->format('c'),
            'updatedAt' => $post->getUpdatedAt()->format('c'),
            'commentsCount' => $post->getComments()->count(),
            'likesCount' => $post->getLikeCount()
        ]);
    }

    #[Post('/posts/{postId}/comments')]
    public function addComment(string $postId, Request $request): Response
    {
        $data = $request->body();

        $command = new AddCommentCommand(
            id: $data['id'] ?? uniqid(),
            postId: $postId,
            author: $data['author'],
            content: $data['content']
        );

        $id = $this->addCommentUseCase->execute($command);

        return new GenericResponse(status: Status::CREATED, body: ['id' => $id]);
    }

    #[Post('/posts/{postId}/likes')]
    public function likePost(string $postId, Request $request): Response
    {
        $data = $request->body();

        $command = new LikePostCommand(
            id: $data['id'] ?? uniqid(),
            postId: $postId,
            userId: $data['userId']
        );

        $id = $this->likePostUseCase->execute($command);

        return new GenericResponse(status: Status::OK, body: ['id' => $id]);
    }
}
