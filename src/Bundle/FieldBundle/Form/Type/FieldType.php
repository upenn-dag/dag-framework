<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\FieldBundle\Form\Type;

use DAG\Bundle\FieldBundle\Form\EventListener\BuildFieldFormChoicesListener;
use DAG\Component\Field\Model\FieldTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Field type.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FieldType extends AbstractType
{
    /**
     * Subject name.
     *
     * @var string
     */
    protected $subjectName;

    /**
     * Prefix.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;

    /**
     * Validation groups.
     *
     * @var array
     */
    protected $validationGroups;

    /**
     * Constructor.
     *
     * @param string $subjectName
     * @param string $prefix
     * @param string $dataClass
     * @param array  $validationGroups
     */
    public function __construct($subjectName, $prefix, $dataClass, array $validationGroups)
    {
        $this->subjectName = $subjectName;
        $this->prefix = $prefix;
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'dag.field.form.name'
            ))
            ->add('presentation', 'text', array(
                'label' => 'dag.field.form.presentation'
            ))
            ->add('type', 'choice', array(
                'label' => 'dag.field.form.type',
                'choices' => FieldTypes::getChoices()
            ))
            ->add('option', 'dag_option_choice', array(
                'label' => 'dag.field.form.option',
                'required' => false
            ))
            ->add('allowMultiple', 'checkbox', array(
                'label' => 'dag.field.form.allow_multiple',
                'required' => false,
            ))
            ->add('addable', 'checkbox', array(
                'label' => 'dag.field.form.addable',
                'required' => false,
            ))
            ->add('order', 'dag_option_order_choice', array(
                'required' => true,
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class'        => $this->dataClass,
                'validation_groups' => $this->validationGroups
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return sprintf('%s_%s_field', $this->prefix, $this->subjectName);
    }
}
