<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DepenseModifyContentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pour', 'entity', array(
                'class' => 'UserBundle:Famille',
                'property' => 'nom',
                'multiple' => false))
            ->add('description')
            ->add('concerne', 'entity', array(
                'class' => 'UserBundle:Famille',
                'property' => 'nom',
                'multiple' => false,
                'required' => false))
            ->add('type', 'choice', array('multiple' => false, 'choices' => array('F&S' => 'Frères et Soeur', 'O&T' => 'Oncles et Tantes')))
            ->add('montant')
            
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Depense'
        ));
    }

    public function getName()
    {
        return 'Depense';
    }
}
