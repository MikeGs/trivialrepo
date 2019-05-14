<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;
use Symfony\Component\Security\Core\Security;

class ProfileFormType extends AbstractType

{
	public function __construct(Security $security)
   	{
         $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('nom', TextType::class, ['required'  => true]);
        $builder->add('cognoms', TextType::class, ['required'  => true]);
        $builder->add('codiAlumne', TextType::class, ['required'  => true]);

        if ($this->security->isGranted('ROLE_ADMIN')) {
        	$builder->remove('current_password');
        }

    }

    public function getParent()
    {
        return BaseProfileFormType::class;
    }
}