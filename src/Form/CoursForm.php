<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Documents;
use App\Entity\Emplois;
use App\Entity\Notes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('code')
            ->add('volume_horaire')
            ->add('description')
            ->add('emplois', EntityType::class, [
                'class' => Emplois::class,
                'choice_label' => 'id',
            ])
            ->add('notes', EntityType::class, [
                'class' => Notes::class,
                'choice_label' => 'id',
            ])
            ->add('documents', EntityType::class, [
                'class' => Documents::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
