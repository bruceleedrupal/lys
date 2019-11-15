<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\OrderItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SetItemQuantityType extends AbstractType
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
        $builder->setAction($this->urlGenerator->generate('cart.setItemQuantity', ['id' => $builder->getData()->getId()]));
        
        $builder->add(
            'quantity',
            ChoiceType::class,
            [
                'choices' =>array_combine(range(1, 20),range(1,20))
            ]
        );

        $builder->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'app.cart.setItemQuantity.button',
                'attr'=>[
                    'class'=>'btn-secondary'
                ]
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderItem::class,
        ));
    }
}