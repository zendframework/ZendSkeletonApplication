<?php

namespace Material\Form;

use Material\Model\MaterialGroupModel;
use Material\Model\MaterialModel;
use Material\Repository\MaterialGroupRepository;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class MaterialGroupForm extends Form
{

    /**
     * @var MaterialGroupRepository
     */
    private $materialGroupRepository;

    /**
     * MaterialGroupForm constructor.
     *
     * @param MaterialGroupRepository $materialGroupRepository
     */
    public function __construct(
        MaterialGroupRepository $materialGroupRepository
    )
    {
        parent::__construct('material_form');

        $this->materialGroupRepository = $materialGroupRepository;

        $inputFilter = new MaterialGroupModel();
        $this->setInputFilter($inputFilter->getInputFilter());

        $this->addFormElements();
    }

    private function addFormElements() : void
    {
        $name = new Text('name');
        $name->setLabel('Name')
            ->setAttribute('class', 'form-control');

        $parent = new Select('parent');
        $parent
            ->setValueOptions(
                $this->getObjectsAsSelect(
                    $this->materialGroupRepository->getAll()
                )
            )
            ->setLabel('Parent Group')
            ->setAttribute('class', 'form-control')
            ->setAttribute('required', false);

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
        $this->add($parent);
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
