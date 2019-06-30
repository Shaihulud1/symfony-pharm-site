<?php

namespace App\Form;

use App\Entity\Landing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LandingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('active') 
            ->add('name')
            ->add('code')
            ->add('phone', TextType::class, [ 'empty_data' => 'Default value'])
            ->add('pharm')
            ->add('about')
            ->add('bonus')
            ->add('action')
            ->add('product')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Landing::class,
        ]);
    }
}
