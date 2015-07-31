<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\PrototypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Prototype form type.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PrototypeType extends AbstractType
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
                'label' => sprintf('%s.%s_prototype.form.name', $this->prefix, $this->subjectName),
            ))
            ->add('presentation', 'text', array(
                'label' => sprintf('%s.%s_prototype.form.presentation', $this->prefix, $this->subjectName),
            ))
            ->add('description', 'text', array(
                'label' => sprintf('%s.%s_prototype.form.description', $this->prefix, $this->subjectName),
                'required' => false,
            ))
            ->add('fields', 'collection', array(
                  'label' => sprintf('%s.%s_prototype.form.fields', $this->prefix, $this->subjectName),
                  'type' => sprintf('%s_%s_prototype_field_choice', $this->prefix, $this->subjectName),
                  'allow_add' => true,
                  'allow_delete' => true,
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
        return sprintf('%s_%s_prototype', $this->prefix, $this->subjectName);
    }
}
