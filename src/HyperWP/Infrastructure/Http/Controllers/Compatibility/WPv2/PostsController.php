<?php

namespace HyperWP\Infrastructure\Http\Controllers\Compatibility\WPv2;

use HyperWP\Domain\Model\PostRepository;
use HyperWP\Infrastructure\Http\Application;
use HyperWP\Infrastructure\Http\Controller;
use HyperWP\Infrastructure\Persistence\SQL\SqlPostRepository;
use HyperWP\Infrastructure\Persistence\SQL\SqlTermRepository;
use HyperWP\Infrastructure\Projections\Compatibility\WPv2\PostProjection;

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
        $termRepository = new SqlTermRepository($this->app->db());

        foreach ($posts as $post) {
            $categories = $termRepository->ofPost($post, 'category');
            $tags = $termRepository->ofPost($post, 'post_tag');

            $projection[] = new PostProjection($post, $categories, $tags);
        }

        return $this->ok($projection);
    }
}