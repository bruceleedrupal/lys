<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="itemOrder", orphanRemoval=true,cascade={"persist"})
     */
    private $orderItem;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $itemsTotal;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $priceTotal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $itemsSingle;
    
    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;
    
    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")     
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="assignedOrders")
     */
    private $belongsTo;
   

  
    


    public function __construct()
    {
        $this->orderItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItem(): Collection
    {
        return $this->orderItem;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItem->contains($orderItem)) {
            $this->orderItem[] = $orderItem;
            $orderItem->setItemOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItem->contains($orderItem)) {
            $this->orderItem->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getItemOrder() === $this) {
                $orderItem->setItemOrder(null);
            }
        }

        return $this;
    }

    public function getItemsTotal(): ?int
    {
        return $this->itemsTotal;
    }

    public function setItemsTotal(int $itemsTotal): self
    {
        $this->itemsTotal = $itemsTotal;

        return $this;
    }

    public function getPriceTotal(): ?float
    {
        return $this->priceTotal;
    }

    public function setPriceTotal(float $priceTotal): self
    {
        $this->priceTotal = $priceTotal;

        return $this;
    }

    public function getItemsSingle(): ?int
    {
        return $this->itemsSingle;
    }

    public function setItemsSingle(?int $itemsSingle): self
    {
        $this->itemsSingle = $itemsSingle;

        return $this;
    }

    public function getBelongsTo(): ?User
    {
        return $this->belongsTo;
    }

    public function setBelongsTo(?User $belongsTo): self
    {
        $this->belongsTo = $belongsTo;

        return $this;
    }

}
