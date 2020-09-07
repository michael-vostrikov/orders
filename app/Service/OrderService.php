<?php
namespace App\Service;

use App\Model\Product;
use App\Model\Order;
use App\Model\OrderPosition;
use App\Exception\LogicException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;

class OrderService
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var PaymentService */
    protected $paymentService;

    public function __construct(EntityManager $entityManager, PaymentService $paymentService)
    {
        $this->entityManager = $entityManager;
        $this->paymentService = $paymentService;
    }

    /**
     * Create order
     * @param int[] $productIdList
     * @throws \Doctrine\ORM\ORMException
     * @return Order
     */
    public function create(array $productIdList)
    {
        $order = new Order();
        $order->setStatus(Order::STATUS_NEW);

        $productRepository = $this->entityManager->getRepository(Product::class);
        $productList = $productRepository->findBy(['id' => $productIdList]);

        if (count($productList) !== count($productIdList)) {
            throw new LogicException('Incorrect product list', LogicException::VALIDATION_ERROR);
        }

        foreach ($productList as $product) {
            $orderPosition = new OrderPosition();
            $orderPosition->setOrder($order);
            $orderPosition->setProduct($product);
            $orderPosition->setPriceAtOrderTime($product->getPrice());

            $order->addOrderPosition($orderPosition);
        }

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order;
    }

    public function pay(int $id, int $sum)
    {
        $this->entityManager->getConnection()->beginTransaction();

        $orderRepository = $this->entityManager->getRepository(Order::class);
        $order = $orderRepository->find($id, LockMode::PESSIMISTIC_WRITE);

        if ($order === null) {
            throw new LogicException('Cannot find order', LogicException::ENTITY_NOT_FOUND);
        }

        /** @var Order $order */
        if ($order->getStatus() !== Order::STATUS_NEW) {
            throw new LogicException('Order is already paid', LogicException::CANNOT_ACCEPT_PAYMENT);
        }

        if ($order->getSum() !== $sum) {
            throw new LogicException('Payment sum is incorrect', LogicException::CANNOT_ACCEPT_PAYMENT);
        }

        $this->paymentService->pay($sum);

        $order->setStatus(Order::STATUS_PAID);
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        $this->entityManager->getConnection()->commit();
    }
}
