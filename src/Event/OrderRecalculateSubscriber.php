<?php

declare(strict_types=1);

namespace App\Event;

use App\Service\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class OrderRecalculateSubscriber implements EventSubscriberInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::ORDER_CREATED => 'recalculate',
            Events::ORDER_UPDATED => 'recalculate',
        ];
    }

    public function recalculate(GenericEvent $event): void
    {
        /** @var OrderInterface $entity */
        $entity = $event->getSubject();


        $itemsTotal = 0;
        $priceTotal = 0;
        $itemsSingle = 0;

        /** @var OrderItemInterface  $item */
        foreach ($entity->getOrderItem() as $item) {
            $itemsTotal += $item->getQuantity();
            $itemsSingle++;            
            $item->setPrice($item->getProduct()->getPrice());
            $item->setPriceTotal($item->getPrice() * $item->getQuantity());
            $priceTotal += $item->getPriceTotal();
        }   

       
        $entity->setItemsTotal($itemsTotal);        
        $entity->setPriceTotal($priceTotal);
        $entity->setItemsSingle($itemsSingle);
    }
}