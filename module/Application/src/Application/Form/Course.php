<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use DoctrineModule\Validator\ObjectExists;

class Course extends AbstractForm
{
    /**
     * Prepare the form elements
     */
    public function prepareElements()
    {
        // Give the form an 'id' attribute of 'course'
        $this->setAttribute('id', 'course');

        // Id
        $id = new Element\Hidden('id');
        $this->add($id);

        // Name
        $name = new Element('name');
        $name->setLabel('Course Name');
        $this->add($name);

        // A cancel button
        $cancel = new Element\Submit('cancel');
        $cancel->setValue('Cancel');
        $cancel->setAttribute('class', 'btn');
        $this->add($cancel);

        // A submit button
        $submit = new Element\Submit('submit');
        $submit->setValue('Submit');
        $submit->setAttribute('class', 'btn btn-info pull-right');
        $this->add($submit);
    }

    /**
     * @return null|\Zend\InputFilter\InputFilter|\Zend\InputFilter\InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->filter) {
            return $this->filter;
        }

        $inputFilter = new InputFilter();
        $entityManager = $this->getServiceLocator()->get('EntityManager');
        $courseRepo    = $entityManager->getRepository('Application\Entity\Course');

        // Id Filter
        $id = new Input('id');
        $id->setRequired(false);
        $idValidator = $id->getValidatorChain();
        $idValidator->addValidator(new ObjectExists(array(
            'object_repository' => $courseRepo,
            'fields'            => array('id')
        )));
        $inputFilter->add($id);

        // Name Filter
        $name = new Input('name');
        $name->setRequired(true);
        $nameValidator = $name->getValidatorChain();
        $nameValidator->addValidator(new Validator\StringLength(array(
            'min' => 3,
            'max' => 254
        )));
        $inputFilter->add($name);

        $this->filter = $inputFilter;
        return $this->filter;
    }
}