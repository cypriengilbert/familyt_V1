<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ObjetListeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $idfamille = $options['idfamille'];

        $builder
        ->add('User', EntityType::class, array(
                                 'class' => 'UserBundle:User',
                                 'choice_label' => 'username',
                                'multiple' => false,
                                'expanded' => false,
                                 'required' => true,
                                 'query_builder' => function (\UserBundle\Repository\UserRepository $er) use($idfamille) {
                                         return $er->createQueryBuilder('u')
                                                    ->leftJoin('u.famille', 'b')
                                              ->where('b.id = :id')
                                              ->orderBy('u.birthday', 'ASC')
                                              ->setParameter('id', $idfamille)


;
                                     }
                             ))
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
            'data_class' => 'AppBundle\Entity\ObjetListe',
            'idfamille' => null,
        ));
    }

    public function getName()
    {
        return 'ObjetListe';
    }
}
