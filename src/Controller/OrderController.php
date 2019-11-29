<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;
use App\Service\OrderFactory;
use App\Service\OrderSessionStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @Route("/order")
 */
class OrderController extends AbstractController
{
    protected $security;
    private $orderRepository;
    private $paginator;    
    private $orderFactory;
    private $orderSessionStorage;
    
    public function __construct(Security $security,OrderRepository $orderRepository,PaginatorInterface $paginator,OrderFactory $orderFactory,
        OrderSessionStorage $orderSessionStorage)
    {
        $this->security = $security;
        $this->orderRepository = $orderRepository;
        $this->paginator = $paginator;
        $this->orderFactory = $orderFactory;
        $this->orderSessionStorage = $orderSessionStorage;
    }
    
    
    /**
     * @Route("/indexall", name="order_indexAll", methods={"GET"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function indexAll(Request $request): Response
    {
        $query= $this->orderRepository->findAllByQueryBuilder()->getQuery();
        
        $orders = $this->paginator->paginate(
            // Doctrine Query, not results
            $query,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
            );
        
        
        return $this->render('order/list/indexAll.html.twig', [
            'orders' => $orders,
            'currentOrderId'=>$this->orderFactory->getCurrent()->getId(),
        ]);
    }
    
    
    /**
     * @Route("/indexcreatedBy", name="order_indexCreatedBy", methods={"GET"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function indexCreateBy(Request $request): Response
    {
        $user = $this->security->getUser();
        
        $query= $this->orderRepository->findAllCreateByQueryBuilder($user)->getQuery();
        
        $orders = $this->paginator->paginate(
            // Doctrine Query, not results
            $query,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
            );
        
        
        return $this->render('order/list/indexCreatedBy.html.twig', [
            'orders' => $orders,
        ]);
    }
    
    /**
     * @Route("/indexbelongsTo", name="order_indexbelongsTo", methods={"GET"})
     * @IsGranted({"ROLE_USER"})
     */
    public function indexbelongsTo(Request $request): Response
    {
        $user = $this->security->getUser();
        
        $query= $this->orderRepository->findAllBelongsToQueryBuilder($user)->getQuery();
        
        $orders =$this->paginator->paginate(
            // Doctrine Query, not results
            $query,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
            );
        
        
        return $this->render('order/list/indexBelongsTo.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/new", name="order_new", methods={"GET","POST"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function new(Request $request): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_show", methods={"GET"})
     */
    public function show(Order $order): Response
    {
        return $this->render('order/show2.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        
        
        $currentOrder = $this->orderFactory->getCurrent();
        

        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('submit')->isClicked()) {
                $this->orderSessionStorage->set($order->getId());
                return $this->redirectToRoute('cart');
            }
            else if($form->get('cancel')->isClicked()){
                return $this->redirectToRoute('order_indexAll');
            }
            return $this->redirectToRoute('order_indexAll');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'currentOrder'=>$currentOrder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index');
    }
}
