<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\Type\mediaType;
use App\Entity\Figure;
use App\Entity\Groupe;
class addFigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder   
            ->add('name' ,TextType::class)
            ->add('description', TextareaType::class)
            ->add('medias', CollectionType::class, [
                'entry_type' => mediaType::class,
                'entry_options' => ['label' => true],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,

            ])
            ->add('groupe' )

        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}