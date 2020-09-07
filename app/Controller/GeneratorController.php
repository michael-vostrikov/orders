<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service\GeneratorService;

class GeneratorController
{
    /** @var GeneratorService  */
    protected $service;

    public function __construct(GeneratorService $service)
    {
        $this->service = $service;
    }

    public function generateProducts()
    {
        return new Response();
    }
}
