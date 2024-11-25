<?php
// src/Infra/Http/ExceptionHandler.php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Http;

use TaskTrek\Core\Application\Exceptions\ApplicationException;
use TaskTrek\Core\Domain\Exceptions\DomainException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

readonly class ExceptionHandler
{
    public function handle(Throwable $exception): ResponseInterface
    {
        return match(true) {
            $exception instanceof ApplicationException => $this->json(['error' => $exception->getMessage()], 400),
            $exception instanceof DomainException => $this->json(['error' => $exception->getMessage()], 422),
            default => $this->handleUnexpectedException($exception)
        };
    }

    private function handleUnexpectedException(Throwable $exception): ResponseInterface
    {
        error_log($exception->getMessage());
        return $this->json(['error' => 'Internal Server Error'], 500);
    }

    private function json(array $data, int $status): ResponseInterface
    {
        return new \GuzzleHttp\Psr7\Response(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode($data, JSON_THROW_ON_ERROR)
        );
    }
}
