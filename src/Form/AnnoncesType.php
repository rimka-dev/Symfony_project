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

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_logement', ChoiceType::class, [
                'choices' => [
                    'Appartement' => 'Appartement',
                    'Maison' => 'Maison'
                ],
                'multiple'=>false,
                'expanded'=>true
            ])
            ->add('prix')
            ->add('nbr_chambre')
            ->add('spf_chambre')
            ->add('chambre_meub')
            ->add('nbr_sdb')
            ->add('superficie')
            ->add('nbr_colocataire')
            ->add('img1', FileType::class, [
                'data_class' => null,
                'label'=> 'Ajouter une image',
                'required'=> true
            ])
            ->add('img2', FileType::class, [
                'data_class' => null,
                'label'=> 'Ajouter une image',
                'required'=> false
            ])
            ->add('img3',FileType::class, [
                'data_class' => null,
                'label'=> 'Ajouter une image',
                'required'=> false
            ])
            ->add('img4',FileType::class, [
                'data_class' => null,
                'label'=> 'Ajouter une image',
                'required'=> false
            ])
            ->add('animaux')
            ->add('animaux_chat')
            ->add('animaux_chien')
            ->add('animaux_rongeur')
            ->add('animaux_autres')
            ->add('pays')
            ->add('region')
            ->add('ville')
            ->add('adresse')
            ->add('comp_adresse')
            ->add('code_postal') 
            ->add('pref_genre', ChoiceType::class, [
                'choices' => [
                    'Un homme' => 'Un homme',
                    'Une femme' => 'Une femme',
                    'Ca m\'est égal' => 'Ca m\'est égal',
                ],
                'multiple'=>false,
                'expanded'=>true
            ] )
            ->add('description', TextareaType::class )
            ->add('fumeur')
            ->add('user',HiddenType::class)
            ->add('equipements', EntityType::class, [
                'by_reference' => false,
                'class'=> Equipements::class,
                'expanded' => true,
                'multiple' => true,
                'choice_attr' => array('checked'=>false),
                'choice_label' => 'nom',
                
            ])
            ->add('loisirs', EntityType::class, [
                'by_reference' => false,
                'class' => Loisirs::class,
                'expanded' => true,
                'multiple' => true,
                'choice_attr' => array('checked'=>false),
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
