<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ChangeCreatedFormType extends AbstractType
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
        $builder->setAction($this->urlGenerator->generate('cart.changeCreated'));
  

        $builder->add('created',DateType::class,
            [                
                'label'=>false,
            ])->add('submit',SubmitType::class,
            [
                'label' => 'app.cart.changeCreated.update',
                'attr'=>[
                    'class'=>'btn btn-info ml-2'
                ]
            ]);        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class          
        ));
    }
}