<?php

namespace App\Controller;

use App\Entity\OrderItem;
use App\Entity\Order;
use App\Entity\Product;
use App\Service\OrderFactory;
use App\Form\AddItemType;
use App\Form\ClearCartType;
use App\Form\RemoveItemType;
use App\Form\SelectBelongsToFormType;
use App\Form\SetItemQuantityType;
use App\Form\ChangeCreatedFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\OrderSessionStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/cart")
 * @IsGranted({"ROLE_ADMIN"})
 */

class CartController extends AbstractController
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    
    private $orderFactory;
    
    private $orderSessionStorage;




    public function __construct(TranslatorInterface  $translator, OrderFactory $orderFactory,OrderSessionStorage $orderSessionStorage)
    {
        $this->translator = $translator;       
        $this->orderFactory = $orderFactory;
        $this->orderSessionStorage = $orderSessionStorage;
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
            $this->addFlash('warning', $this->translator->trans('app.cart.addItem.message.success',['%title%'=>$product->getTitle()]));
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
        $selectMemberForm = $this->createForm(SelectBelongsToFormType::class, $order); 
        $changeCreatedForm = $this->createForm(ChangeCreatedFormType::class, $order); 
        
        
        return $this->render('cart/index.html.twig', [
            'orderFactory' => $orderFactory,
            'order'=>$order,
            'clearForm' => $clearForm->createView(),  
            'selectMemberForm'=>$selectMemberForm->createView(),
            'itemsInCart' => $order->getItemsTotal(),
            'changeCreatedForm'=>$changeCreatedForm->createView()
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
            if($form->get('submit')->isClicked()){
                $this->orderFactory->clear();
            }
            else if($form->get('finish')->isClicked()){
                $this->orderSessionStorage->set(NULL);
            }
              
          
         //   $this->addFlash('success', $this->translator->trans('app.cart.clear.message.success'));
        }
        
        return $this->redirectToRoute('product_index');
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
            $this->addFlash('warning', $this->translator->trans('app.cart.setItemQuantity.message.success',['%title%'=>$item->getProduct()->getTitle(),'%quantity%'=>$item->getQuantity()]));
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
            $this->addFlash('warning', $this->translator->trans('app.cart.removeItem.message.success',['%title%'=>$item->getProduct()->getTitle()]));
        }
        
        return $this->redirectToRoute('cart');
    }
    
    /**
     * @Route("/selectmember", name="cart.selectMember", methods={"POST"})
     */
    public function selectMember(Request $request, OrderFactory $orderFactory): Response
    {
        $order = $orderFactory->getCurrent();
        
        $form = $this->createForm(SelectBelongsToFormType::class, $order);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->orderFactory->updateBindings();
            
            if($order->getBelongsTo())
                $this->addFlash('warning', $this->translator->trans('app.cart.selectBelongsTo.update',['%title%'=>$order->getBelongsTo()->getUsername()]));
            else 
              $this->addFlash('warning', $this->translator->trans('app.cart.selectBelongsTo.updateEmpty'));
        }
        
        return $this->redirectToRoute('cart');
    }
    
    /**
     * @Route("/changeCreated", name="cart.changeCreated", methods={"POST"})
     */
    public function changeCreated(Request $request, OrderFactory $orderFactory): Response
    {
        $order = $orderFactory->getCurrent();
        
        $form = $this->createForm(ChangeCreatedFormType::class, $order);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->orderFactory->updateBindings();
            $this->addFlash('warning', $this->translator->trans('app.cart.changeCreated.updated',['%title%'=>$order->getCreated()->format('Y-m-d')]));
          
        }
        
        return $this->redirectToRoute('cart');
    }
    
    
}