<?php

namespace App\Form;

use App\Entity\Pharm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('pharm_pic')
            ->add('coords')
            ->add('type')
            ->add('address')
            ->add('advantage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pharm::class,
        ]);
    }
}
