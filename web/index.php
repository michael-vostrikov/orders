<?php

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\HttpKernel\ControllerResolver;

require(__DIR__ . '/../vendor/autoload.php');


$routes = include(__DIR__ . '/../config/routes.php');

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);
$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

$container = include(__DIR__ . '/../config/container.php');

$kernel = new HttpKernel($dispatcher, new ControllerResolver($container), new RequestStack(), new ArgumentResolver());

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
