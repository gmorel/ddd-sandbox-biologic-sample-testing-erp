<?php

namespace Api\ConsumableEngine\UI\Request\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Validate and hydrate NotifyBiologicTestHasBeenLaunchedCommand
 * @hint FormType is here to quickly validate POST Request (UI validation)
 *        Lead to easily catch bad type/format error without getting fat Controller
 * @hint FormType is not responsible for Domain validation (complex validation)
 * @author Guillaume MOREL <guillaume.morel@verylastroom.com>
 */
class NotifyBiologicTestHasBeenLaunchedFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('biologic_test_id', 'text', array('property_path' => 'biologicTestId'))
            ->add('number_of_used_tube', 'number', array('property_path' => 'numberOfUsedTube'))
            ->add('launched_at', 'datetime', array('property_path' => 'launchedAtUTC'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'NotifyBiologicTestHasBeenLaunched';
    }
}
