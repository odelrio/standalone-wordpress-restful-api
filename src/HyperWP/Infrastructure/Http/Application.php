<?php

namespace HyperWP\Infrastructure\Http;

use HyperWP\Infrastructure\Http\Controllers\V1\PostsController as PostsControllerV1;
use HyperWP\Infrastructure\Http\Controllers\Compatibility\WPv2\PostsController as PostsControllerWPv2;
use PDO;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\RouteParser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application
{
    const APP_NAME = 'HyperWP';
    const APP_DIR = 'HyperWP';
    const PROJECT_ROOT = __DIR__ . '/../../../../standalone-wordpress-restful-api/';
    const SRC_ROOT = self::PROJECT_ROOT . 'src/';
    const CONFIG_ROOT = self::PROJECT_ROOT . 'config/';
    const VENDOR_ROOT = self::PROJECT_ROOT . 'vendor/';
    const SUPPORT_ROOT = self::PROJECT_ROOT . 'support/';
    const APP_ROOT = self::SRC_ROOT . self::APP_DIR . '/';
    const DOCUMENT_ROOT = self::APP_ROOT . '/Infrastructure/Http/Silex/Public/';

    /** @var Application */
    private static $instance = null;
    /** @var PDO */
    private $dbh = null;
    /** @var RouteCollector */
    private $router;

    /**
     * @return Application
     */
    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = self::bootstrap();
        }

        return self::$instance;
    }

    /**
     * @return Application
     */
    private static function bootstrap($routes = []): self
    {
        $app = new self;
        $app->router = new RouteCollector(new RouteParser());

        return $app;
    }

    public function db()
    {
        if (!$this->dbh) {
            $this->dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return $this->dbh;
    }

    public function route(array $routes)
    {
        foreach ($routes as $uri => $handler) {
            $this->router->any($uri, $handler);
        }
    }

    public function run()
    {
        /** @var Response $response */
        $dispatcher = new Dispatcher($this->router->getData());
        $request = Request::createFromGlobals();
        $response = null;

        try {
            $response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
        } catch (HttpRouteNotFoundException $ex) {
            $response = new Response('Not found', 404);
        } catch (\Exception $ex) {
            die(var_dump($ex));
        } finally {
            if ($response) {
                $response->prepare($request)->send();
            }
        }
    }
}