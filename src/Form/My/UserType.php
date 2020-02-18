<?php

namespace App\Form\My;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Contracts\Translation\TranslatorInterface;
class UserType extends AbstractType
{
    
    /**
     * @var TranslatorInterface
     */
    private $translator;
    
    public function __construct(TranslatorInterface  $translator)
    {
        $this->translator = $translator;        
    }
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,[
                'label'=>'用户名'
            ])
            ->add('passwordOld',PasswordType::class,[
                'mapped'=>false,
                'label'=>'原密码',
                'required'=>false,
            ])
           ->add('passwordNew',PasswordType::class,[
                'mapped'=>false,
                'label'=>'新密码',
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
