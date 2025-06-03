<?php

namespace App\Form;

use App\Entity\Emplois;
use App\Entity\enseignants;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploisForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('salle')
            ->add('jour')
            ->add('heure_debut')
            ->add('heure_fin')
            ->add('enseignant_id', EntityType::class, [
                'class' => enseignants::class,
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
