<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

use Symfony\Component\HttpFoundation\Request;
use App\Controller\GeneratorController;
use App\Controller\OrderController;


$routes = new RouteCollection();

$routes->add('generator/generate',
    (new Route('/generator/generate-products', [
        '_controller' => [GeneratorController::class, 'generateProducts'],
    ]))->setMethods(Request::METHOD_POST)
);

$routes->add('order/create',
    (new Route('/order', [
        '_controller' => [OrderController::class, 'create'],
    ]))->setMethods(Request::METHOD_POST)
);

$routes->add('order/pay', (
    new Route('/order/pay/{id}', [
        '_controller' => [OrderController::class, 'pay'],
    ]))->setMethods(Request::METHOD_POST)
);

return $routes;
