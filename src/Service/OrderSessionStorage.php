<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderSessionStorage 
{
    const ORDER_KEY_NAME = 'orderId';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function set(?int $orderId): void
    {
        $this->session->set(self::ORDER_KEY_NAME, $orderId);
    }

    public function remove(): void
    {
        $this->session->remove(self::ORDER_KEY_NAME);
    }

    public function getOrderById(): ?Order
    {     
       if ($this->has()) {
            return $this->entityManager->getRepository('App\Entity\Order')->findOneById($this->get());
        }

        return null;
    }

    public function has(): bool
    {
        return $this->session->has(self::ORDER_KEY_NAME);
    }

    public function get(): ?int
    { 
       return $this->session->get(self::ORDER_KEY_NAME);
    }
}