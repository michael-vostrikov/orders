<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service\OrderService;

class OrderController
{
    /** @var OrderService  */
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return new Response();
    }

    public function pay(int $id)
    {
        return new Response();
    }
}
