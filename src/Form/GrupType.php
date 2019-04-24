<?php

namespace App\Form;

use App\Entity\Grup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('codi')
            ->add('datainici')
            ->add('datafinal')
            ->add('finalitzat')
            ->add('tempsresposta')
            ->add('idAdministrador')
            ->add('puntuacio_facil')
            ->add('puntuacio_dificil')
            ->add('idNivell')
            ->add('idUsuari')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Grup::class,
        ]);
    }
}
