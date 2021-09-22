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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnoncesLogement extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_logement', ChoiceType::class, [
                'choices' => [
                    'Appartement' => 'Appartement',
                    'Maison' => 'Maison',
                ],
                'multiple'=>false,'expanded'=>true
            ])
            ->add('prix')
            ->add('nbr_chambre')
            ->add('spf_chambre')
            ->add('chambre_meub')
            ->add('nbr_sdb')
            ->add('superficie')
            ->add('nbr_colocataire')
         
            ->add('pays')
            ->add('region')
            ->add('ville')
            ->add('adresse')
            ->add('comp_adresse')
            ->add('code_postal')

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
