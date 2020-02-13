<?php 
namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Security;
class MenuBuilder 
{
    protected $security;
    protected $factory;
  
    
    public function __construct(FactoryInterface $factory,Security $security)
    {
        $this->factory = $factory;
        $this->security = $security;
    }

    public function createSidebar(array $options)
    {
        
        $isAdmin = $this->security->isGranted('ROLE_ADMIN');
        $isLoggedin = $this->security->isGranted('ROLE_USER');
        
        $menu = $this->factory->createItem('root',[
            'childrenAttributes'=>[
            'class'=>'nav nav-pills nav-sidebar flex-column',
            'data-widget'=>'treeview',
            'role'=>'menu',
            'data-accordion'=>false,           
            ],
            
        ]);

        if($isLoggedin) {
        $menu->addChild('gdlb',[
            'uri'=>'#',
            'label' => "<i class='nav-icon fa fa-list-alt'></i>工单 ",
            'linkAttributes'=>['class'=>'nav-link'],
            'childrenAttributes'=>[
                'class'=>'nav nav-treeview',               
            ],
            'attributes'=>[
                'class'=>'nav-item has-treeview',
            ],
            'extras' => array('safe_label' => true),
        ]);
        }
       
       
        if($isAdmin) {
        $menu['gdlb']->addChild('sygd', [
            'route' => 'order_indexAll' ,
            'label' => "<i class='nav-icon fa fa-circle nav-icon'></i>工单详情",
            'linkAttributes'=>['class'=>'nav-link'],
            'attributes'=>[
                'class'=>'nav-item',
            ],
            'extras' => array('safe_label' => true),
        ]);
        
        
        
        
        
        $menu['gdlb']->addChild('order_gdtj', [
            'route' => 'order_gdtj',            
            'label' => "<i class='nav-icon fa fa-circle nav-icon'></i>工单统计",
            'linkAttributes'=>['class'=>'nav-link'],
            'attributes'=>[
                'class'=>'nav-item',
            ],
            'extras' => array('safe_label' => true),
        ]);
        
        $menu['gdlb']->addChild('wdgd', [
            'route' => 'order_indexCreatedBy',
             'label' => "<i class='nav-icon fa fa-circle nav-icon'></i>我创建的工单",
            'linkAttributes'=>['class'=>'nav-link'],
            'attributes'=>[
                'class'=>'nav-item',
            ],
            'extras' => array('safe_label' => true),
        ]);
        }
        
        if($isLoggedin) {
        $menu['gdlb']->addChild('fpgwgd', [
            'route' => 'order_indexbelongsTo',
            'label' => "<i class='nav-icon fa fa-circle nav-icon'></i>分配给我的工单",
            'linkAttributes'=>['class'=>'nav-link'],
            'attributes'=>[
                'class'=>'nav-item',
            ],
            'extras' => array('safe_label' => true),
        ]);
        }
        
        
        if($isAdmin) {
        $menu->addChild('yhgl',[
            'uri'=>'#',
            'label' => "<i class='nav-icon fa fa-user'></i>用户管理 ",
            'linkAttributes'=>['class'=>'nav-link'],
            'childrenAttributes'=>[
                'class'=>'nav nav-treeview',
            ],
            'attributes'=>[
                'class'=>'nav-item has-treeview',
            ],
            'extras' => array('safe_label' => true),
        ]);
        
        $menu['yhgl']->addChild('yhlb', [
            'route' => 'user_index',
            'label' => "<i class='nav-icon fa fa-circle nav-icon'></i>用户列表",
            'linkAttributes'=>['class'=>'nav-link'],
            'attributes'=>[
                'class'=>'nav-item',
            ],
            'extras' => array('safe_label' => true),
        ]);
        }
        
        
        return $menu;
    }
}