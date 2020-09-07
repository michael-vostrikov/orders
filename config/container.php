<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

use App\Service\GeneratorService;
use App\Service\OrderService;
use App\Controller\GeneratorController;
use App\Controller\OrderController;

$containerBuilder = new ContainerBuilder();

$containerBuilder->register(GeneratorService::class, GeneratorService::class);
$containerBuilder->register(OrderService::class, OrderService::class);

$containerBuilder->register(GeneratorController::class, GeneratorController::class)
    ->addArgument(new Reference(GeneratorService::class));
$containerBuilder->register(OrderController::class, OrderController::class)
    ->addArgument(new Reference(OrderService::class));

return $containerBuilder;
