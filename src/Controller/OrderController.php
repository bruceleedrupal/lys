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
/**
 * @Route("/order")
 */
class OrderController extends AbstractController
{
    protected $security;
    
    
    
    public function __construct(Security $security)
    {
        $this->security = $security;
       
    }
    
    
    /**
     * @Route("/indexall", name="order_indexAll", methods={"GET"})
     */
    public function indexAll(OrderRepository $orderRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $query= $orderRepository->findAllByQueryBuilder()->getQuery();
        
        $orders = $paginator->paginate(
            // Doctrine Query, not results
            $query,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
            );
        
        
        return $this->render('order/list/indexAll.html.twig', [
            'orders' => $orders,
        ]);
    }
    
    
    /**
     * @Route("/indexcreatedBy", name="order_indexCreatedBy", methods={"GET"})
     */
    public function indexCreateBy(OrderRepository $orderRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $user = $this->security->getUser();
        
        $query= $orderRepository->findAllCreateByQueryBuilder($user)->getQuery();
        
        $orders = $paginator->paginate(
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
     * @Route("/new", name="order_new", methods={"GET","POST"})
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
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
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
