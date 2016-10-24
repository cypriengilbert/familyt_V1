<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ObjetListeModifyContentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('commentaire')
            ->add('url')
            ->add('commun',CheckboxType::class, array(
    'label'    => 'Cochez pour un cadeau commun au couple',
    'required' => false,
))
            ->add('communfamille', CheckboxType::class, array(
    'label'    => 'Cochez pour un cadeau commun à la famille',
    'required' => false,
))




        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ObjetListe'
        ));
    }

    public function getName()
    {
        return 'ObjetListe';
    }
}
