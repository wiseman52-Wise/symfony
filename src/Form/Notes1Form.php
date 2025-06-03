<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Etudiants;
use App\Entity\Notes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Notes1Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('date_eval')
            ->add('etudiant', EntityType::class, [
                'class' => Etudiants::class,
                'choice_label' => 'id',
            ])
            ->add('cours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notes::class,
        ]);
    }
}
