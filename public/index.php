<?php

use App\Controllers\TaskController;
use App\RedirectResponse;
use App\ViewResponse;
use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

//twig
$loader = new FilesystemLoader(__DIR__ . '/../views/');
$twig = new Environment($loader);

//dotenv
$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

//di
// Load the container

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../bootstrap/container.php');

$container = $containerBuilder->build();


//router routes
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [TaskController::class, 'index']);
    $r->addRoute('GET', '/tasks/create', [TaskController::class, 'create']);
    $r->addRoute('POST', '/', [TaskController::class, 'store']);
    $r->addRoute('GET', '/tasks/{id:\d+}', [TaskController::class, 'show']);
    $r->addRoute('POST', '/tasks/{id:\d+}/delete', [TaskController::class, 'delete']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;

        // Use the container to resolve the controller instance
        $taskController = $container->get($controller);

        // Call the controller method with the resolved instance and route variables
        $response = $taskController->{$method}(...array_values($vars));

        switch (true) {
            case $response instanceof ViewResponse:
                echo $twig->render($response->getViewName() . '.twig', $response->getData());
                break;

            case $response instanceof RedirectResponse:
                header('Location: ' . $response->getLocation());
                break;

            default:
                break;
        }
        break;
}
