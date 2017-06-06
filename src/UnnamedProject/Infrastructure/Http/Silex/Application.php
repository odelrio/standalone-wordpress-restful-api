<?php

namespace UnnamedProject\Infrastructure\Http\Silex;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application as SilexApplication;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class Application extends SilexApplication
{
    const APP_NAME = 'Unnamed Project';
    const APP_DIR = 'UnnamedProject';
    const PROJECT_ROOT = __DIR__ . '/../../../../../';
    const SRC_ROOT = self::PROJECT_ROOT . 'src/';
    const CONFIG_ROOT = self::PROJECT_ROOT . 'config/';
    const VENDOR_ROOT = self::PROJECT_ROOT . 'vendor/';
    const SUPPORT_ROOT = self::PROJECT_ROOT . 'support/';
    const APP_ROOT = self::SRC_ROOT . self::APP_DIR . '/';
    const DOCUMENT_ROOT = self::APP_ROOT . '/Infrastructure/Http/Silex/Public/';

    private static $instance = null;

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

        $app['debug'] = true;

        $app->register(new DoctrineServiceProvider(), [
            'db.options'    => [
                'driver'        => 'pdo_sqlite',
                'path'          => self::SUPPORT_ROOT . 'wordpress/wp-content/database/wordpress.sqlite',
//                'driver' => 'pdo_mysql',
//                'host' => '127.0.0.1',
//                'dbname' => 'wordpress',
//                'user' => 'root',
//                'password' => 'toor',
//                'driverOptions' => array(1002 => 'SET NAMES utf8',),
//                'charset'       => 'utf8'
            ]
        ]);

        $app->register(new DoctrineOrmServiceProvider(), [
            'orm.em.options' => [
                'mappings' => [
                    [
                        'type'      => 'simple_yml',
                        'namespace' => 'UnnamedProject\Domain\Model',
                        'path'      => realpath( self::CONFIG_ROOT . 'doctrine/')
                    ]
                ]
            ]
        ]);

        $app->register(new SerializerServiceProvider());

        return $app;
    }

    private function getJsonResponse($data, $code): Response
    {
        $jsonData = $this['serializer']->serialize($data, 'json');

        return new Response($jsonData, $code, ['Content-Type' => 'application/json']);
    }

    public function ok($data = null): Response
    {
        return $this->getJsonResponse($data, 200);
    }

    public function badRequest($data = null): Response
    {
        return $this->getJsonResponse($data, 400);
    }

    public function unauthorized($data = null): Response
    {
        return $this->getJsonResponse($data, 401);
    }

    public function forbidden($data = null): Response
    {
        return $this->getJsonResponse($data, 403);
    }

    public function notFound($data = null): Response
    {
        return $this->getJsonResponse($data, 404);
    }

    public function methodNotAllowed($data = null): Response
    {
        return $this->getJsonResponse($data, 405);
    }

    public function ko($data = null): Response
    {
        return $this->getJsonResponse($data, 500);
    }

    public function unavailable($data = null): Response
    {
        return $this->getJsonResponse($data, 503);
    }
}