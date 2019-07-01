<?php

namespace App\Form;

use App\Entity\Bonus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('text')
            ->add('label_text')
            ->add('label_color')
            ->add('title_color')
            ->add('bonus_pic')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bonus::class,
        ]);
    }
}
