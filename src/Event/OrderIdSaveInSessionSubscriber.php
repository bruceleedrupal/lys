<?php

declare(strict_types=1);

namespace App\Event;

use App\Service\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\OrderSessionStorage;

class OrderIdSaveInSessionSubscriber implements EventSubscriberInterface
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
            Events::ORDER_CREATED => 'onOrderCreated',
        ];
    }

    public function onOrderCreated(GenericEvent $event): void
    {   
        $this->session->set(OrderSessionStorage::ORDER_KEY_NAME, $event->getSubject()->getId());
    }
}