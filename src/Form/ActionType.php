<?php

namespace App\Form;

use App\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('action_pic')
            ->add('logo_pic')
            ->add('text')
            ->add('text_color')
            ->add('label_color')
            ->add('label_text')
            ->add('url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
