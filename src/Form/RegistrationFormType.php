<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('nom', TextType::class, ['required'  => true]);
        $builder->add('cognoms', TextType::class, ['required'  => true]);
        $builder->add('codiAlumne', TextType::class, ['required'  => true]);

    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}
