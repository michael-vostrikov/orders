<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

use App\Service\GeneratorService;
use App\Service\OrderService;
use App\Controller\GeneratorController;
use App\Controller\OrderController;

use Doctrine\ORM\EntityManager;


$containerBuilder = new ContainerBuilder();

require_once(__DIR__ . '/db-bootstrap.php');

$entityManager = createEntityManager();
$containerBuilder->set(EntityManager::class, $entityManager);

$containerBuilder->register(GeneratorService::class, GeneratorService::class)
    ->addArgument(new Reference(EntityManager::class));
$containerBuilder->register(OrderService::class, OrderService::class)
    ->addArgument(new Reference(EntityManager::class));

$containerBuilder->register(GeneratorController::class, GeneratorController::class)
    ->addArgument(new Reference(GeneratorService::class));
$containerBuilder->register(OrderController::class, OrderController::class)
    ->addArgument(new Reference(OrderService::class));


return $containerBuilder;
