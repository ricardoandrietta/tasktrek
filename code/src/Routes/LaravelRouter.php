<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\RouteCollection;

// Create container
$container = Container::getInstance();

// Create events dispatcher
$events = new Dispatcher($container);

// Create router
$router = new Router($events, $container);

// Define routes
$router->get('/', function() {
    return 'Hello World';
});

//$router->post('/register', function(Request $request) use ($authAdapter) {
//    try {
//        $user = $authAdapter->register(
//            $request->input('email'),
//            $request->input('password')
//        );
//        return ['message' => 'User registered successfully', 'user' => $user];
//    } catch (\Exception $e) {
//        return ['error' => $e->getMessage()];
//    }
//});

// Create request from globals
$request = Request::capture();

// Dispatch the request through the router
$response = $router->dispatch($request);

// Send the response
$response->send();
