<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Equipements;
use App\Entity\Loisirs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\File;

class AnnoncesPhotos extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('img1', FileType::class, [
            'label'=> 'Ajouter une image',
            'required'=> true,
            'data_class' => null,
        ])
        ->add('img2', FileType::class, [
            'label'=> 'Ajouter une image',
            'data_class' => null,
            'required'=> false
        ])
        ->add('img3',FileType::class, [
            'label'=> 'Ajouter une image',
            'required'=> false,
            'data_class' => null,
        ])
        ->add('img4',FileType::class, [
            'label'=> 'Ajouter une image',
            'required'=> false,
            'data_class' => null,
        ])

        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'save']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
