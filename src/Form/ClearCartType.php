<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ClearCartType extends AbstractType
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($this->urlGenerator->generate('cart.clear'));

        $builder->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'app.cart.clear.button',
                'attr'=>[
                    'icon' => 'fa fa-trash',
                    'class'=>'btn-warning',
                    'onclick'=>'return confirm("Are you sure you want to delete this item?")'
                 ]
            ]
        );
        $builder->add(
            'clone',
            SubmitType::class,
            [
                'label' => 'app.cart.clone.button',
                'attr'=>[
                    'icon' => 'fa fa-copy',
                    'class'=>'btn-success',                    
                ]
            ]
            );
        
        
        $builder->add(
            'finish',
            SubmitType::class,
            [
                'label' => 'app.cart.finish.button',                
                'attr'=>[           
                    'icon' => 'fa fa-check-circle',
                    'class'=>'btn-success',
                    'onclick'=>'return confirm("Are you sure you want to finish this item?")'
                ]
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class,
            
        ));
    }
}