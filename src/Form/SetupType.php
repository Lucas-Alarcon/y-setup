<?php

namespace App\Form;

use App\Entity\Setup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SetupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('youtubeur')
            ->add('equipments', null, array('expanded' => true, 'multiple' => true, 'required' => false, 'label' => false, 'by_reference' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Setup::class,
        ]);
    }
}
