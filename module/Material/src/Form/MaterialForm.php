<?php

namespace Material\Form;

use Material\Model\MaterialModel;
use Material\Repository\MaterialGroupRepository;
use Material\Repository\MaterialRepository;
use Unit\Repository\UnitRepository;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class MaterialForm extends Form
{

    /**
     * @var MaterialGroupRepository
     */
    private $materialGroupRepository;

    /**
     * @var UnitRepository
     */
    private $unitRepository;

    /**
     * MaterialForm constructor.
     *
     * @param MaterialGroupRepository $materialGroupRepository
     * @param UnitRepository $unitRepository
     */
    public function __construct(
        MaterialGroupRepository $materialGroupRepository,
        UnitRepository $unitRepository
    )
    {
        parent::__construct('material_form');

        $this->materialGroupRepository = $materialGroupRepository;
        $this->unitRepository          = $unitRepository;

        $inputFilter = new MaterialModel();
        $this->setInputFilter($inputFilter->getInputFilter());

        $this->addFormElements();
    }

    private function addFormElements() : void
    {
        $name = new Text('name');
        $name->setLabel('Name')
            ->setAttribute('class', 'form-control');

        $csrf = new Csrf('csrf');
        $csrf->setOptions([
            'csrf_options' => [
                'timeout' => 600,
            ],
        ]);

        $materialGroup = new Select('material_group');
        $materialGroup
            ->setValueOptions(
                $this->getObjectsAsSelect(
                    $this->materialGroupRepository->getAll()
                )
            )
            ->setLabel('Material Group')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', true);

        $unit = new Select('unit');
        $unit
            ->setValueOptions(
                $this->getObjectsAsSelect(
                    $this->unitRepository->getAll()
                )
            )
            ->setLabel('Unit')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', true);

        $submit = new Submit('save');
        $submit->setValue('Save')
            ->setAttribute('class', 'btn btn-success');

        $this->add($name);
        $this->add($materialGroup);
        $this->add($csrf);
        $this->add($submit);
    }



    /**
     * @param $objects
     * @param String $getter1
     * @param String $getter2
     * @return array
     */
    private function getObjectsAsSelect($objects, String $getter1 = 'getId', String $getter2 = 'getName') : array
    {
        $options = [];

        foreach($objects as $object)
        {
            $options[$object->$getter1()] = $object->$getter2();
        }

        return $options;
    }

}
