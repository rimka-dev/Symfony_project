<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            /* ->add('roles', HiddenType::class) */
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('img_avatar',FileType::class, [
                'data_class' => null,
                'label'=> 'Ajouter une image',
                'required'=> false
            ])
            ->add('pays')
            ->add('region')
            ->add('ville')
            ->add('adresse_user')
            ->add('code_postal')
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

