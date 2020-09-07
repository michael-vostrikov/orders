<?php
namespace App\Service;

use App\Model\Product;
use Doctrine\ORM\EntityManager;

class GeneratorService
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Generates products and saves them to database
     * @param int $number  Number of products to generate
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function generateProducts($number = 20)
    {
        for ($i = 0; $i < $number; $i++) {
            $product = $this->createProduct($i);
            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();
    }

    /**
     * @param int $index
     * @return Product
     */
    protected function createProduct(int $index)
    {
        $product = new Product();
        $product->setName('Product ' . ($index + 1));
        $product->setPrice(rand(10, 100) * 10);

        return $product;
    }
}
