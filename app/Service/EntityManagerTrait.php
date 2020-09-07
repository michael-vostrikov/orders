<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;

trait EntityManagerTrait
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
