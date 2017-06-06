<?php

namespace UnnamedProject\Infrastructure\Http\Silex\Controllers;

use Doctrine\ORM\EntityManager;
use Silex\Api\ControllerProviderInterface;
use Silex\Application as SilexApplication;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Response;
use UnnamedProject\Infrastructure\Http\Silex\Application;

class PostsController implements ControllerProviderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(SilexApplication $app)
    {
        $this->entityManager = $app['orm.em'];

        $controllers = $app['controllers_factory'];

        $controllers->get('/', [$this, 'index'])->bind('posts_index');
        $controllers->get('/{id}/{slug}/', [$this, 'show'])->bind('posts_show');

        return $controllers;
    }

    public function index(Application $app)
    {
	    $dql = "SELECT p FROM \UnnamedProject\Domain\Model\Posts p WHERE p.postType = 'post' AND p.postStatus = 'publish'";

	    $posts = $this->entityManager->createQuery($dql)->getResult();

        return $app->ok($posts);
    }
}