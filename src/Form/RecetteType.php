<?php

namespace App\Form;

use App\Entity\Recettes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('preparation')
            ->add('note')
            ->add('pays')
            ->add('photo')
            ->add('favoris')
            ->add('user_id')
            ->add('ingredients')
            ->add('video')
            ->add('type')
            ->add('id_ingredient')
            ->add('id_user')
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
