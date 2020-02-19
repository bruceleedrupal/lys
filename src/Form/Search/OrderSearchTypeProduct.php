<?php

namespace App\Form\Search;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class OrderSearchTypeProduct extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
              
        
        $builder
        ->add('order_start',DateType::class,
            [                
                'widget'=>'single_text',                
                'required'=>false,
            ])
        ->add('order_end',DateType::class,
            [
                'widget'=>'single_text',
                'required'=>false,
            ])
        ->add('user',EntityType::class,[
            'class'=>User::class,
            'required'=>false,
            'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('u')->andWhere('u.roles like :role')
            ->setParameter('role', '%ROLE_CUSTOMER%');
            },
            'choice_label'=>'username'])
        ->add('product',EntityType::class,[
            'class'=>Product::class,
            'required'=>false,
            'query_builder' => function (EntityRepository $er) {
               return $er->createQueryBuilder('p');               
            },
            'choice_label'=>'title'])
        ->add('submit',SubmitType::class,[           
            'label'=>'过滤',            
            'attr'=>[
                'class'=>'btn btn-success'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method'=>'GET',
            'csrf_protection'=>false,
            'attr'=>[
                'class'=>'form-inline mb-3'
            ]
        ]);
    }
    
    public function getBlockPrefix(){
        return '';
    }
}
