<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Entity\Product;
use App\Service\OrderFactory;
use App\Form\AddItemType;
use App\Form\ClearCartType;
use App\Form\RemoveItemType;
use App\Form\SetDiscountType;
use App\Form\SetItemQuantityType;
use App\Form\SetPaymentType;
use App\Form\SetShipmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/cart")
 */

class CartController extends AbstractController
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    
    private $orderFactory;




    public function __construct(TranslatorInterface  $translator, OrderFactory $orderFactory)
    {
        $this->translator = $translator;       
        $this->orderFactory = $orderFactory;
    }
    
    
    public function addItemForm(Product $product): Response
    {  
        $form = $this->createForm(AddItemType::class, $product);
        
        return $this->render('cart/_addItem_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    
    public function cartBlock(OrderFactory $orderFactory): Response
    {
        $order = $orderFactory->getCurrent();
        
        return $this->render('cart/_cart_block.html.twig', [
            'order' => $order
        ]);        
    }
    
    public function cartSummaryBlock(OrderFactory $orderFactory): Response
    {
        $order = $orderFactory->getCurrent();
        
        return $this->render('cart/_cart_summary_block.html.twig', [
            'order' => $order
        ]);
    }
    
    public function setItemQuantityForm(OrderItem $item): Response
    {
        $form = $this->createForm(SetItemQuantityType::class, $item);
        
        return $this->render('cart/_setItemQuantity_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    public function removeItemForm(OrderItem $item): Response
    {
        $form = $this->createForm(RemoveItemType::class, $item);
        
        return $this->render('cart/_removeItem_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    
    
    /**
     * @Route("/addItem/{id}", name="cart.addItem", methods={"POST"})
     */
    public function addItem(Request $request, Product $product): Response
    {
      
        $form = $this->createForm(AddItemType::class, $product);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->orderFactory->addItem($product, 1);
            $this->addFlash('success', $this->translator->trans('app.cart.addItem.message.success'));
        }
        
        return $this->redirect($request->headers->get('referer'));;
    }
    
    
    /**
     * @Route("/", name="cart")
     */
    public function cart(OrderFactory $orderFactory)
    {
        $order = $orderFactory->getCurrent();
        $clearForm = $this->createForm(ClearCartType::class, $order);        
        
        
        return $this->render('cart/index.html.twig', [
            'orderFactory' => $orderFactory,
            'order'=>$order,
            'clearForm' => $clearForm->createView(),          
            'itemsInCart' => $order->getItemsTotal()
        ]);
    }
    
    
    /**
     * @Route("/clear", name="cart.clear", methods={"POST"})
     */
    public function clear(Request $request): Response
    {
        $form = $this->createForm(ClearCartType::class, $this->orderFactory->getCurrent());
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->orderFactory->clear();
            $this->addFlash('success', $this->translator->trans('app.cart.clear.message.success'));
        }
        
        return $this->redirectToRoute('home');
    }
    
    
    
    
    
    /**
     * @Route("/setItemQuantity/{id}", name="cart.setItemQuantity", methods={"POST"})
     */
    public function setQuantity(Request $request, OrderItem $item): Response
    {
        $form = $this->createForm(SetItemQuantityType::class, $item);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->orderFactory->setItemQuantity($item, $form->getData()->getQuantity());
            $this->addFlash('success', $this->translator->trans('app.cart.setItemQuantity.message.success'));
        }
        
        return $this->redirectToRoute('cart');
    }
    
    /**
     * @Route("/removeItem/{id}", name="cart.removeItem", methods={"POST"})
     */
    public function removeItem(Request $request, OrderItem $item): Response
    {
        $form = $this->createForm(RemoveItemType::class, $item);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->orderFactory->removeItem($item);
            $this->addFlash('success', $this->translator->trans('app.cart.removeItem.message.success'));
        }
        
        return $this->redirectToRoute('cart');
    }
    
    
}