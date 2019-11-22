<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SelectBelongsToFormType extends AbstractType
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
        $builder->setAction($this->urlGenerator->generate('cart.selectMember'));
  

        $builder->add(
            'belongsTo',
            EntityType::class,
            [
                'class' => User::class,
                'label'=>false,
                'choice_label' => 'username',
                'placeholder' => 'app.cart.selectBelongsTo.select',                
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class          
        ));
    }
}