<?php

namespace HyperWP\Infrastructure\Http;

use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    public function ok($data = null): Response
    {
        return new Response(json_encode($data), 200, ['Content-Type' => 'application/json']);
    }

    public function badRequest($data = null): Response
    {
        return new Response(json_encode($data), 400, ['Content-Type' => 'application/json']);
    }

    public function unauthorized($data = null): Response
    {
        return new Response(json_encode($data), 401, ['Content-Type' => 'application/json']);
    }

    public function forbidden($data = null): Response
    {
        return new Response(json_encode($data), 403, ['Content-Type' => 'application/json']);
    }

    public function notFound($data = null): Response
    {
        return new Response(json_encode($data), 404, ['Content-Type' => 'application/json']);
    }

    public function methodNotAllowed($data = null): Response
    {
        return new Response(json_encode($data), 405, ['Content-Type' => 'application/json']);
    }

    public function ko($data = null): Response
    {
        return new Response(json_encode($data), 500, ['Content-Type' => 'application/json']);
    }

    public function unavailable($data = null): Response
    {
        return new Response(json_encode($data), 503, ['Content-Type' => 'application/json']);
    }
}