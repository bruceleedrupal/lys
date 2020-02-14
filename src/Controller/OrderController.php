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
use App\Form\Search\OrderSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
        
        
        
        $searchForm = $this->createForm(OrderSearchType::class);
        
        
        $qb = $this->orderRepository->createQueryBuilder('o');
        
        $searchForm->handleRequest($request);
        
        if($searchForm->isSubmitted() && $searchForm->isValid()){
            $searchData= $searchForm->getData();
            if($searchData['order_start']) {
                $qb->andWhere('o.created >=:order_start')
                ->setParameter('order_start', $searchData['order_start']);
            }
            if($searchData['order_end']) {
                $qb->andWhere('o.created<=:order_end')
                ->setParameter('order_end', $searchData['order_end']);
            }
            if($searchData['user']){
                $qb->andWhere('o.belongsTo=:user')
                ->setParameter('user', $searchData['user']);
            }
        }
        
        
        
        $orders = $this->paginator->paginate(
            // Doctrine Query, not results
            $qb->getQuery(),
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
            );
        
        
        return $this->render('order/list/indexAll.html.twig', [
            'orders' => $orders,
            'currentOrderId'=>$this->orderFactory->getCurrent()->getId(),
            'searchForm'=>$searchForm->createView()
        ]);
    }
    
    
    /**
     * @Route("/gdtj.{_format}", defaults={"page": "1", "_format"="html"},name="order_gdtj", methods={"GET"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function orderGdtj(Request $request,string $_format): Response
    {   
       
        
        $firstDayOfMonth = date('Y-m-01', strtotime(date("Y-m-d")));
        $lastDayofMonth = date('Y-m-d', strtotime("$firstDayOfMonth +1 month -1 day"));
        $currentMonthUrl = $this->generateUrl('order_gdtj',['order_start'=>$firstDayOfMonth,'order_end'=>$lastDayofMonth]);
        
        $firstDayOfYear = date('Y-01-01', strtotime(date("Y-m-d")));
        $lastDayofYear = date('Y-m-d', strtotime("$firstDayOfYear +1 year -1 day"));
        $currentYearUrl = $this->generateUrl('order_gdtj',['order_start'=>$firstDayOfYear,'order_end'=>$lastDayofYear]);
        
        
        $firstDayOfLastMonth = date('Y-m-01', strtotime(date("Y-m-d")." -1 month"));
        $lastDayofLastMonth = date('Y-m-d', strtotime("$firstDayOfLastMonth +1 month -1 day"));
        $lastMonthUrl = $this->generateUrl('order_gdtj',['order_start'=>$firstDayOfLastMonth,'order_end'=>$lastDayofLastMonth]);
        
        $firstDayOfLastYear = date('Y-01-01', strtotime(date("Y-m-d")." -1 year"));
        $lastDayofLastYear = date('Y-m-d', strtotime("$firstDayOfLastYear +1 year -1 day"));
        $lastYearUrl = $this->generateUrl('order_gdtj',['order_start'=>$firstDayOfLastYear,'order_end'=>$lastDayofLastYear]);
        
        $searchForm = $this->createForm(OrderSearchType::class);
        
        
        if(!$searchForm->isSubmitted()){  
           $searchForm->get('order_start')->setData(\DateTime::createFromFormat('Y-m-d', $firstDayOfMonth));
           $searchForm->get('order_end')->setData(\DateTime::createFromFormat('Y-m-d', $lastDayofMonth));
        }
        $qb = $this->orderRepository->createQueryBuilder('o');
        $qb->select('sum(o.priceTotal) as sumPriceTotal,o as order,YEAR(o.created) as oyear,MONTH(o.created) as omonth');  
        
        $searchForm->handleRequest($request);
        
        if($order_start = $searchForm->get('order_start')->getData() ) {
            $qb->andWhere('o.created >=:order_start')
            ->setParameter('order_start', $order_start);
        }
        
        if($order_end = $searchForm->get('order_end')->getData()) {
            $qb->andWhere('o.created<=:order_end')
            ->setParameter('order_end', $order_end);
        }
        if($order_user = $searchForm->get('user')->getData()){
            $qb->andWhere('o.belongsTo=:user')
            ->setParameter('user', $order_user);
            $qb->groupBy('oyear,omonth');
            $qb->orderBy('oyear','desc');
            $qb->addOrderBy('omonth','desc');            
        }
        else {
            $qb->groupBy('o.belongsTo');
            $qb->orderBy('sumPriceTotal','desc');
        }
        
       
        $qb->andWhere('o.belongsTo is not null');              
        
        
        
        
        
       
        if($_format=='xls'){
            $filename= 'gdtj'.($order_start ? $order_start->format('Ymd'):'').($order_end ? '-'.$order_end->format('Ymd'):'').".xlsx";
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $orders = $qb->getQuery()->getResult();
            
            
            if(!$order_user) {
                $sheet
                ->setCellValue('A1', '员工')
                ->setCellValue('B1', '合计');
                
                foreach($orders as $i=>$order){
                    $sheet
                    ->setCellValue('A'.(string)($i+2), $order['order']->getBelongsTo()->getUsername())
                    ->setCellValue('B'.(string)($i+2), $order['sumPriceTotal']);
                }
            }
           
            else {
                $sheet
                ->setCellValue('A1', '时间')
                ->setCellValue('B1', '员工')
                ->setCellValue('C1', '合计');
                
                $sumTotal=0 ;
                foreach($orders as $i=>$order){
                    $sumTotal += $order['sumPriceTotal'];
                    $sheet
                    ->setCellValue('A'.(string)($i+2), $order['oyear'].'/'.$order['omonth'])
                    ->setCellValue('B'.(string)($i+2), $order['order']->getBelongsTo()->getUsername())
                    ->setCellValue('C'.(string)($i+2), $order['sumPriceTotal']);
                }
                $sheet->setCellValue('C'.(string)($i+3), $sumTotal);               
            }
            
            
          
            
            $writer = new Xlsx($spreadsheet);
            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');
            
            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0
            $writer->save('php://output');
            exit;
        }
        
        
        
        
        $orders = $this->paginator->paginate(
            // Doctrine Query, not results
            $qb->getQuery(),
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10,
            ['distinct'=>false,
             'wrap-queries' => true
            ]
        );
        
        if(!$order_user) {
            return $this->render('order/list/gdtj.html.twig', [
                'orders' => $orders,
                'searchForm'=>$searchForm->createView(),
                'currentMonthUrl'=>$currentMonthUrl,
                'currentYearUrl'=>$currentYearUrl,
                'lastMonthUrl'=> $lastMonthUrl,
                'lastYearUrl' => $lastYearUrl,                
            ]);
        }
        else {
            return $this->render('order/list/gdtj_user.html.twig', [
                'orders' => $orders,
                'searchForm'=>$searchForm->createView(),
                'currentMonthUrl'=>$currentMonthUrl,
                'currentYearUrl'=>$currentYearUrl,
                'lastMonthUrl'=> $lastMonthUrl,
                'lastYearUrl' => $lastYearUrl,
                'order_user'=> $order_user
            ]);
        }
        
        
        
        
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
     * @Route("/{id}/pdf", name="order_show_pdf", methods={"GET"})
     */
    public function showpdf(Order $order): Response
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
