<?php

namespace App\Form;

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
            ->add('roles',ChoiceType::class,[
                'choices'  =>[
                 //   $this->translator->trans('ROLE_SUPER_ADMIN') => 'ROLE_SUPER_ADMIN',
                    $this->translator->trans('ROLE_ADMIN') => 'ROLE_ADMIN',
                    $this->translator->trans('ROLE_MEMEBER') => 'ROLE_MEMEBER',                 
                ],                
                'label'=>'角色',
                'multiple'=>true,
                'required'=>false,
            ])
           ->add('password',PasswordType::class,[
                'mapped'=>false,
                'label'=>'密码',
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
