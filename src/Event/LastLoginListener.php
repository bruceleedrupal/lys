<?php
/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;
use App\Service\OrderFactory;
use Doctrine\ORM\EntityManagerInterface;

class LastLoginListener implements EventSubscriberInterface
{
    protected $security;
    
    private $entityManager;
    
    private $orderFactory;
    /**
     * LastLoginListener constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security,EntityManagerInterface $entityManager, OrderFactory $orderFactory)
    {
        $this->security = $security;
        $this->entityManager =$entityManager;
        $this->orderFactory = $orderFactory;
    }
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(            
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );
    }
  
    /**
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if ($user instanceof User) {
            $user->setLastLogin(new \DateTime());
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
        
        
        $order =$this->orderFactory->getCurrent();
        if($order->getId() &&  !$order->getCreatedBy()) {
            $order->setCreatedBy($user);
            $this->entityManager->persist($order);
            $this->entityManager->flush();
        }
    }
}