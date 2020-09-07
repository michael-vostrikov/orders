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
        $order = $this->service->create($productIdList);

        return new JsonResponse(['id' => $order->getId(), 'sum' => $order->getSum()]);
    }

    public function pay(Request $request, int $id)
    {
        $data = $this->getJsonRequestData($request);
        $this->service->pay($id, $data['sum']);

        return new JsonResponse(['success' => true]);
    }

    protected function getJsonRequestData(Request $request)
    {
        if ($request->getContentType() === static::REQUEST_TYPE_JSON) {
            $content = $request->getContent();
            return json_decode($content, true);
        }

        return null;
    }
}
