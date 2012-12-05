<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Add extends Form
{
    public function prepareElements()
            
    {        
        $this->setAttribute('id', 'add');

        // A cancel button
        $cancel = new Element\Submit('add');
        $cancel->setValue('Cancel');
        $cancel->setAttribute('class', 'btn');
        $this->add($cancel);

        // A submit button
        $confirm = new Element\Submit('confirm');
        $confirm->setValue('confirm');
        $confirm->setAttribute('class', 'btn btn-danger pull-right');
        $this->add($confirm);
    }
}