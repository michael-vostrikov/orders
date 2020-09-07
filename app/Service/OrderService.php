<?php
namespace App\Service;

use App\Model\Product;
use App\Model\Order;
use App\Model\OrderPosition;

class OrderService
{
    use EntityManagerTrait;

    /**
     * Create order
     * @param int[] $productIdList
     * @throws \Doctrine\ORM\ORMException
     * @return int
     */
    public function create(array $productIdList)
    {
        $order = new Order();
        $order->setStatus(Order::STATUS_NEW);

        $productRepository = $this->entityManager->getRepository(Product::class);
        $productList = $productRepository->findBy(['id' => $productIdList]);

        foreach ($productList as $product) {
            $orderPosition = new OrderPosition();
            $orderPosition->setOrder($order);
            $orderPosition->setProduct($product);

            $order->addOrderPosition($orderPosition);
        }

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order->getId();
    }
}
