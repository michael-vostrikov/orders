<?php
namespace App\HttpKernel;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Instatiate controller by DI container
 */
class ControllerResolver extends \Symfony\Component\HttpKernel\Controller\ControllerResolver
{
    /** @var ContainerInterface */
    public $container;

    public function __construct(ContainerInterface $container, LoggerInterface $logger = null)
    {
        $this->container = $container;
        parent::__construct($logger);
    }

    protected function instantiateController(string $class)
    {
        return $this->container->get($class);
    }
}
