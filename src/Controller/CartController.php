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
    
    
    public function cartBlock(OrderFactory $order): Response
    {
        $order = $order->getCurrent();
        
        return $this->render('cart/_cart_block.html.twig', [
            'order' => $order
        ]);        
    }
    
    public function cartSummaryBlock(OrderFactory $order): Response
    {
        $order = $order->getCurrent();
        
        return $this->render('cart/_cart_summary_block.html.twig', [
            'order' => $order
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
        
        return $this->redirectToRoute('product_index');
    }
}