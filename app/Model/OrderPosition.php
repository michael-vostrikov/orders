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

    /**
     * @var int  Product price can change between order creation and payment
     * @ORM\Column(name="price_at_order_time", type="integer")
     */
    protected $priceAtOrderTime;

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

    public function getPriceAtOrderTime()
    {
        return $this->priceAtOrderTime;
    }

    public function setPriceAtOrderTime(int $priceAtOrderTime)
    {
        $this->priceAtOrderTime = $priceAtOrderTime;
    }
}
