<?php

namespace HyperWP\Infrastructure\Http\Controllers\V1;

use HyperWP\Domain\Model\PostRepository;
use HyperWP\Infrastructure\Http\Application;
use HyperWP\Infrastructure\Http\Controller;
use HyperWP\Infrastructure\Persistence\SQL\SqlAuthorRepository;
use HyperWP\Infrastructure\Persistence\SQL\SqlPostRepository;
use HyperWP\Infrastructure\Persistence\SQL\SqlTermRepository;
use HyperWP\Infrastructure\Projections\V1\PostProjection;

class PostsController extends Controller
{
    /** @var Application */
    private $app;
    /** @var PostRepository */
    private $repository;

    /**
     * PostsController constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->repository = new SqlPostRepository($this->app->db());
    }

    public function index()
    {
        $posts = $this->repository->all();
        $projection = [];
        $authorRepository = new SqlAuthorRepository($this->app->db());
        $termRepository = new SqlTermRepository($this->app->db());

        foreach ($posts as $post) {
            $author = $authorRepository->find($post->authorId);
            $categories = $termRepository->ofPost($post, 'category');
            $tags = $termRepository->ofPost($post, 'post_tag');

            $projection[] = new PostProjection($post, $author, $categories, $tags);
        }

        return $this->ok($projection);
    }
}