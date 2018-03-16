<?php

namespace Unit\Form;

use Unit\Model\UnitModel;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class UnitForm extends Form
{

    /**
     * UnitForm constructor.
     */
    public function __construct()
    {
        parent::__construct('material_form');

        $inputFilter = new UnitModel();
        $this->setInputFilter($inputFilter->getInputFilter());

        $this->addFormElements();
    }

    private function addFormElements() : void
    {
        $name = new Text('name');
        $name->setLabel('Name')
            ->setAttribute('class', 'form-control');

        $shortName = new Text('short_name');
        $shortName->setLabel('Short Name')
            ->setAttribute('class', 'form-control');

        $csrf = new Csrf('csrf');
        $csrf->setOptions([
            'csrf_options' => [
                'timeout' => 600,
            ],
        ]);

        $submit = new Submit('save');
        $submit->setValue('Save')
            ->setAttribute('class', 'btn btn-success');

        $this->add($name);
        $this->add($shortName);
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
