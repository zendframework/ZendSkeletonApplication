<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Delete extends Form
{
    public function prepareElements()
    {
        $this->setAttribute('id', 'delete');

        // A cancel button
        $cancel = new Element\Submit('cancel');
        $cancel->setValue('Cancel');
        $cancel->setAttribute('class', 'btn');
        $this->add($cancel);

        // A submit button
        $delete = new Element\Submit('delete');
        $delete->setValue('Delete');
        $delete->setAttribute('class', 'btn btn-danger pull-right');
        $this->add($delete);
    }
}