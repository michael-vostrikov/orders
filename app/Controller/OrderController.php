<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\OrderService;

class OrderController
{
    /** @var OrderService  */
    protected $service;

    const REQUEST_TYPE_JSON = 'json';

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $productIdList = $this->getJsonRequestData($request);
        $orderId = $this->service->create($productIdList);

        return new JsonResponse(['id' => $orderId]);
    }

    public function pay(int $id)
    {
        return new JsonResponse();
    }

    protected function getJsonRequestData(Request $request)
    {
        if ($request->getContentType() === static::REQUEST_TYPE_JSON) {
            $content = $request->getContent();
            return json_decode($content);
        }

        return null;
    }
}
