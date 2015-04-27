<?php

namespace Album\Form;

use Zend\Form\Form;

/*
 * Within the constructor of AlbumForm we do several things. First, we set the name of the form as we call the parents
 * constructor. we create four form elements: the id, title, artist, and submit button. For each item we set various attributes
 * and options, including the label to be displayed.
 */
class AlbumForm extends Form {
	public function __construct($name = null) {
		// we want to ignore the name passed
		parent::__construct ( 'album' );

		$this->add ( array (
				'name' => 'id',
				'type' => 'Hidden'
		) );
		$this->add ( array (
				'name' => 'title',
				'type' => 'Text',
				'options' => array (
						'label' => 'Title'
				),
				'attributes' => array (
						'placeholder' => 'i.e.Book Titile'
				)
		) );
		$this->add ( array (
				'name' => 'artist',
				'type' => 'Text',
				'options' => array (
						'label' => 'Artist'
				),
				'attributes' => array (
						'placeholder' => 'i.e. Abdul Kalam'
				)
		) );
		$this->add ( array (
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array (
						'value' => 'Go',
						'id' => 'submitbutton'
				)
		) );
	}
}