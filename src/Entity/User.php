<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password     
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $lastLogin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="belongsTo")
     */
    private $assignedOrders;
    
    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->assignedOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    
    
    /**
     * @see UserInterface
     */
    public function getDisplayRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER       
        
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    public function getAvatarUrl(string $size = '24'): string
    {
        $url = 'https://ui-avatars.com/api/?name='.mb_substr($this->getUsername(),-2);
        
        if ($size)
            $url .= sprintf('&size=%d', $size);
            return $url;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getAssignedOrders(): Collection
    {
        return $this->assignedOrders;
    }

    public function addAssignedOrder(Order $assignedOrder): self
    {
        if (!$this->assignedOrders->contains($assignedOrder)) {
            $this->assignedOrders[] = $assignedOrder;
            $assignedOrder->setBelongsTo($this);
        }

        return $this;
    }

    public function removeAssignedOrder(Order $assignedOrder): self
    {
        if ($this->assignedOrders->contains($assignedOrder)) {
            $this->assignedOrders->removeElement($assignedOrder);
            // set the owning side to null (unless already changed)
            if ($assignedOrder->getBelongsTo() === $this) {
                $assignedOrder->setBelongsTo(null);
            }
        }

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
