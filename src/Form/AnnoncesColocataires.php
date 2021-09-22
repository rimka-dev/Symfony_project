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


class AnnoncesColocataires extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pref_genre', ChoiceType::class, [
            'choices' => [
                'Un homme' => 'Un homme',
                'Une femme' => 'Une femme',
                'Ca m\'est égal' => 'Ca m\'est égal',
            ],
            'multiple'=>false,'expanded'=>true
        ])
        ->add('animaux_chat')
        ->add('animaux_chien')
        ->add('animaux_rongeur')
        ->add('animaux_autres')

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
