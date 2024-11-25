<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Http\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract readonly class Controller
{
    abstract public function handle(ServerRequestInterface $request): ResponseInterface;

    protected function json(array $data, int $status = 200): ResponseInterface
    {
        return new \GuzzleHttp\Psr7\Response(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode($data, JSON_THROW_ON_ERROR)
        );
    }
}
