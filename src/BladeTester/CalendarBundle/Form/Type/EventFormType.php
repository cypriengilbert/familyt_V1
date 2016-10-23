<?php

namespace BladeTester\CalendarBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventFormType extends AbstractType {

    protected $dataClass;

    public function __construct($dataClass)
    {
        $this->dataClass = $dataClass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => 'bladetester_calendar.label.event.title',
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'label' => 'bladetester_calendar.label.event.description',
            ))
            
                ->add('start', null, ['required' => true, 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'attr' => ['class' => 'datepicker']], array(
                'label' => 'bladetester_calendar.label.event.start')
            )
            ->add('end', null, ['required' => true, 'widget' => 'single_text', 'format' => 'dd-MM-yyyy', 'attr' => ['class' => '']], array(
                'label' => 'bladetester_calendar.label.event.start')
            )
           
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'event';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->dataClass
        ));
    }
}
