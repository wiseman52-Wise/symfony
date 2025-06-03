<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Emplois;
use App\Entity\Enseignants;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Emplois1Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('salle')
            ->add('jour')
            ->add('heure_debut')
            ->add('heure_fin')
            ->add('cours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'id',
            ])
            ->add('enseignant', EntityType::class, [
                'class' => Enseignants::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emplois::class,
        ]);
    }
}
