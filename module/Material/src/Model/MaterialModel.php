<?php

namespace Material\Model;

use Doctrine\Common\Persistence\ObjectRepository;
use DoctrineModule\Validator\UniqueObject;
use Material\Repository\MaterialRepository;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class MaterialModel
 *
 * @package Material\Model
 */
class MaterialModel implements InputFilterAwareInterface
{

    /**
     * @var InputFilter
     */
    private $inputFilter;

    /**
     * @var MaterialRepository
     */
    private $materialRepository;

    /**
     * MaterialModel constructor.
     *
     * @param MaterialRepository $materialRepository
     */
    public function __construct(
        MaterialRepository $materialRepository
    ) {
        $this->materialRepository = $materialRepository;
    }

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
                            [
                                'name'    => UniqueObject::class,
                                'options' => [
                                    'object_manager'    => $this->materialRepository->getEntityManager(),
                                    'object_repository' => $this->materialRepository->getRepository(),
                                    'fields'            => ['name'],
                                    'use_context'       => true,
                                    'messages'          => [
                                        UniqueObject::ERROR_OBJECT_NOT_UNIQUE => "Name '%value%' is already in use",
                                    ]
                                ]
                            ]
                        ],
                    ]
                )
            );

            $inputFilter->add(
                $factory->createInput(
                    [
                        'name'       => 'id',
                        'required'   => false,
                    ]
                )
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
