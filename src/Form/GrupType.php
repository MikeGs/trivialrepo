<?php

namespace App\Form;

use App\Entity\Grup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GrupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('codi')
            ->add('datainici', null, array(
                'label' => "Data d'inici",
            ))
            ->add('datafinal', null, array(
                'label' => "Data límit",
            ))
            ->add('finalitzat')
            ->add('tempsresposta', null, array(
                'label' => 'Temps de resposta',
            ))
            ->add('idAdministrador')
            ->add('puntuacio_facil', null, array(
                'label' => 'Puntuació preguntes fàcils',
            ))
            ->add('puntuacio_dificil', null, array(
                'label' => 'Puntuació preguntes difícils',
            ))
            ->add('idNivell', null, array(
                'label' => 'Nivell',
            ))
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
