<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit',SubmitType::class,[
                'label'=>'载入修改',
                'attr'=>[
                    'class'=>'btn btn-danger'
                ]
            ])
            ->add('cancel',SubmitType::class,[
                'label'=>'取消修改',
                'attr'=>[
                    'class'=>'btn btn-info'
                ]
            ]);
    }


}
