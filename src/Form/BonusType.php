<?php

namespace App\Form;

use App\Entity\Bonus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('url')
            ->add('bonus_pic_file', FileType::class, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bonus::class,
        ]);
    }
}
