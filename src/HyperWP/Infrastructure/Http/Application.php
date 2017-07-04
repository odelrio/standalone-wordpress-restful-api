<?php

namespace HyperWP\Infrastructure\Http;

use HyperWP\Infrastructure\Http\Controllers\V1\PostsController as PostsControllerV1;
use HyperWP\Infrastructure\Http\Controllers\Compatibility\WPv2\PostsController as PostsControllerWPv2;
use Symfony\Component\HttpFoundation\Request;

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

    private static $instance = null;
    private $dbh = null;

    /**
     * @return Application
     */
    public static function getInstance(): self
    {
        if (self::$instance == null)
        {
            self::$instance = self::bootstrap();
        }

        return self::$instance;
    }

    /**
     * @return Application
     */
    private static function bootstrap(): self
    {
        $app = new self;

        return $app;
    }

    public function db()
    {
        if (!$this->dbh) {
            $this->dbh = new \PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }

        return $this->dbh;
    }

    public function run()
    {
        $request = Request::createFromGlobals();

        if ($request->getPathInfo() === '/posts') {
            $controller = new PostsControllerV1($this);
            $response = $controller->index();
            $response->prepare($request)->send();
        } else if ($request->getPathInfo() === '/compat/wp/v2/posts') {
            $controller = new PostsControllerWPv2($this);
            $response = $controller->index();
            $response->prepare($request)->send();
        }
    }
}