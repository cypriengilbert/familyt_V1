<?php

namespace AppBundle\Form;

use AppBundle\Form\Type\typeDeDepenseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DepenseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pour', EntityType::class, array(
                                   'class' => 'UserBundle:Famille',
                                   'choice_label' => 'nom',
                                  'multiple' => true,
                                  'expanded' => true,
                                   'required' => true))
            ->add('description')
            ->add('idsouhait')

            ->add('concerne', 'entity', array(
                'class' => 'UserBundle:Famille',
                'property' => 'nom',
                'multiple' => false,
                'required' => false))
            ->add('type', 'choice', array(  'required'=>true,  'placeholder' => '','multiple' => false, 'choices' => array('F&S' => 'Cadeau des Frères et Soeur', 'O&T' => 'Cadeau des Oncles et Tantes', 'remboursement' => 'Avance', 'moitie' => 'Parts égales')))
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

}
