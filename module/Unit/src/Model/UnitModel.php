<?php

namespace Unit\Model;

use Doctrine\Common\Persistence\ObjectRepository;
use DoctrineModule\Validator\UniqueObject;
use Unit\Repository\UnitRepository;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class UnitModel
 *
 * @package Unit\Model
 */
class UnitModel implements InputFilterAwareInterface
{

    /**
     * @var InputFilter
     */
    private $inputFilter;

    /**
     * @param InputFilterInterface $inputFilter
     *
     * @return void|InputFilterAwareInterface
     */
    public function setInputFilter(\Zend\InputFilter\InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return InputFilter|InputFilterInterface
     */
    public function getInputFilter() : InputFilterInterface
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new Factory();

            $inputFilter->add(
                $factory->createInput(
                    [
                        'name'       => 'name',
                        'required'   => true,
                        'filters'    => [
                            [
                                'name' => 'StringTrim'
                            ],
                        ],
                        'validators' => [
                            [
                                'name'    => 'StringLength',
                                'options' => [
                                    'min'  => 3,
                                    'max'  => 64,
                                ],
                            ],
                        ],
                    ]
                )
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
