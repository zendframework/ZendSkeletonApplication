<?php

namespace Material\Form;

use Material\Model\MaterialModel;
use Material\Repository\MaterialRepository;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class MaterialForm extends Form
{

    /**
     * MaterialForm constructor.
     *
     * @param MaterialRepository $materialRepository
     */
    public function __construct(
        MaterialRepository $materialRepository
    )
    {
        parent::__construct('material_form');

        $inputFilter = new MaterialModel($materialRepository);
        $this->setInputFilter($inputFilter->getInputFilter());

        $this->addFormElements();
    }

    private function addFormElements() : void
    {
        $id = new Hidden('id');

        $name = new Text('name');
        $name->setLabel('Name')
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

        $this->add($id);
        $this->add($name);
        $this->add($csrf);
        $this->add($submit);
    }

}
