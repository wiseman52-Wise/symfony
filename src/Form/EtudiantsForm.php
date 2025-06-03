<?php

namespace App\Form;

use App\Entity\Etudiants;
use App\Entity\Notes;
use App\Entity\users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule')
            ->add('date_naissance')
            ->add('adresse')
            ->add('telephone')
            ->add('photo')
            ->add('users_id', EntityType::class, [
                'class' => users::class,
                'choice_label' => 'id',
            ])
            ->add('notes', EntityType::class, [
                'class' => Notes::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiants::class,
        ]);
    }
}
