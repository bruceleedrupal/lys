<?php 
namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser 
{ 
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")    
     
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="member")
     */
    private $orders;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;
    
    
    
    
    /**    
     * @ORM\PrePersist()
     */
    public function setEmailUser(){
        
        $this->email = $this->username;
    }
    
    public function __construct()
    {
        parent::__construct();
        $this->orders = new ArrayCollection();
        // your own logic
    }
    
    public function getAvatarUrl(string $size = '24'): string
    {
        $url = 'https://ui-avatars.com/api/?name='.$this->getUsername();
       
        if ($size)
            $url .= sprintf('&size=%d', $size);        
        return $url;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setMember($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getMember() === $this) {
                $order->setMember(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}