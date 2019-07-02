<?php

namespace App\Form;

use App\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('action_pic_file', FileType::class, [
                'mapped'      => false,
                'required'    => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/svg+xml',
                            'image/png'
                        ],
                        'maxSizeMessage'   => 'Изображение слишком большого размера',
                        'mimeTypesMessage' => 'Изображение может быть только формата jpg, png, jpeg, svg',
                    ])
                ], 
            ])
            ->add('logo_file', FileType::class, [
                'label'       => 'Логотип акции',
                'mapped'      => false,
                'required'    => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/svg+xml',
                            'image/png'
                        ],
                        'maxSizeMessage'   => 'Изображение слишком большого размера',
                        'mimeTypesMessage' => 'Изображение может быть только формата jpg, png, jpeg, svg',
                    ])
                ],
            ])
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
