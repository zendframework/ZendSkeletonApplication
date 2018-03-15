<?php

namespace Material\Form;

use Zend\Form\Element\Text;
use Zend\Form\Form;

class MaterialForm extends Form
{

    public function __construct()
    {
        parent::__construct('amterial_form');

        $this->addFormElements();
    }

    private function addFormElements() : void
    {
        $name = new Text('name');
        $name->setLabel('Name');

        $this->add($name);
    }

}
