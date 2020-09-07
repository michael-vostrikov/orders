<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 */
class Order
{
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var int  Status is int and not ENUM to avoid alter table on adding new statuses
     * @ORM\Column(name="`status`", type="integer")
     */
    protected $status;

    /**
     * @var OrderPosition[]
     * @ORM\OneToMany(targetEntity="OrderPosition", mappedBy="order", cascade={"persist"})
     */
    protected $orderPositions;

    public function __construct()
    {
        $this->orderPositions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getOrderPositions()
    {
        return $this->orderPositions;
    }

    public function addOrderPosition($orderPosition)
    {
        $this->orderPositions->add($orderPosition);
    }
}
