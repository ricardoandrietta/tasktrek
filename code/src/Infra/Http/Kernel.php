<?php

declare(strict_types=1);

namespace TaskTrek\Core\Infra\Http;

use Illuminate\Container\Container;
use Illuminate\Routing\Router;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class Kernel
{
    public function __construct(
        private Router $router,
        private Container $container
    ) {}

    public function run(): never
    {
        $request = ServerRequestFactory::fromGlobals();

        $response = $this->handle($request);

        $this->emit($response);
        exit;
    }

    private function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Convert PSR-7 request to Illuminate Request
        $illuminateRequest = Request::createFromBase(
            \Symfony\Component\HttpFoundation\Request::createFromGlobals()
        );

        $response = $this->router->dispatch($illuminateRequest);

        // Convert Illuminate Response to PSR-7 Response
        return $this->convertToPsr7Response($response);
    }

    private function emit(ResponseInterface $response): void
    {
        (new SapiEmitter())->emit($response);
    }

    private function convertToPsr7Response($illuminateResponse): ResponseInterface
    {
        return new \GuzzleHttp\Psr7\Response(
            $illuminateResponse->getStatusCode(),
            $illuminateResponse->headers->all(),
            $illuminateResponse->getContent()
        );
    }
}
