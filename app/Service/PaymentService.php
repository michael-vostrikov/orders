<?php
namespace App\Service;

use App\Exception\LogicException;
use GuzzleHttp\Client;
use \Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

class PaymentService
{
    public function pay(int $sum)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get('https://ya.ru');

            $isPaymentSuccess = ($response->getStatusCode() === Response::HTTP_OK);
            if (!$isPaymentSuccess) {
                throw new LogicException('Payment was not successed', LogicException::PAYMENT_SERVICE_ERROR);
            }

        } catch (GuzzleException $ex) {
            echo $ex; die;
            throw new LogicException('Cannot connect to payment service', LogicException::PAYMENT_SERVICE_ERROR);
        }
    }
}
