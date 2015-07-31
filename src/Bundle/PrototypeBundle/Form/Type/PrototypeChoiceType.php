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
use DAG\Component\Prototype\Provider\PrototypeProviderInterface;

/**
 * Prototype choice form type.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PrototypeChoiceType extends AbstractType
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
     * Prototype provider.
     *
     * @var PrototypeProviderInterface
     */
    protected $provider;


    /**
     * Constructor.
     *
     * @param string $subjectName
     * @param string $prefix
     * @param PrototypeProviderInterface $provider
     */
    public function __construct($subjectName, $prefix, PrototypeProviderInterface $provider)
    {
        $this->subjectName = $subjectName;
        $this->prefix = $prefix;
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'class' => $this->provider->getPrototypeModelClass(),
                'choices' => $this->provider->getPrototypes(),
                'property' => 'presentation',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return sprintf('%s_%s_prototype_choice', $this->prefix, $this->subjectName);
    }
}
