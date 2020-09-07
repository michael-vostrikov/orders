<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_position")
 */
class OrderPosition
{
    /**
     * @var Order
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Order")
     */
    protected $order;

    /**
     * @var Product
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Product")
     */
    protected $product;

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }
}
