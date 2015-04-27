<?php

namespace Album\Model;

// Add these import statements
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/*
 *
 * The InputFilterAwareInterface defines two methods: setInputFilter() and getInputFilter().
 * We only need to implement getInputFilter() so we simply throw an exception in setInputFilter().
 */
class Album implements InputFilterAwareInterface {
	public $id;
	public $artist;
	public $title;
	private $inputFilter;

	/*
	 * Our Album entity object is a simple PHP class. In order to work with Zend\Dbs TableGateway class, we need
	 * to implement the exchangeArray() method. This method simply copies the data from the passed in array to our
	 * entitys properties. We will add an input filter for use with our form later.
	 */
	public function exchangeArray($data) {
		$this->id = (! empty ( $data ['id'] )) ? $data ['id'] : null;
		$this->artist = (! empty ( $data ['artist'] )) ? $data ['artist'] : null;
		$this->title = (! empty ( $data ['title'] )) ? $data ['title'] : null;
	}

	// Add content to these methods:
	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception ( "Not used" );
	}

	/*
	 *
	 * Within getInputFilter(), we instantiate an InputFilter and then add the inputs that we require. We add
	 * one input for each property that we wish to filter or validate. For the id field we add an Int filter as we only need
	 * integers. For the text elements, we add two filters, StripTags and StringTrim, to remove unwanted HTML and
	 * unnecessary white space. We also set them to be required and add a StringLength validator to ensure that the user
	 * doesnt enter more characters than we can store into the database.
	 */
	public function getInputFilter() {
		if (! $this->inputFilter) {
			$inputFilter = new InputFilter ();

			$inputFilter->add ( array (
					'name' => 'id',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'Int'
							)
					)
			) );

			$inputFilter->add ( array (
					'name' => 'artist',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100
									)
							)
					)
			) );

			$inputFilter->add ( array (
					'name' => 'title',
					'required' => true,
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'StringLength',
									'options' => array (
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100
									)
							)
					)
			) );

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
	public function getArrayCopy() {
		return get_object_vars ( $this );
	}
	/*
	 * We now need to get the form to display and then process it on submission.
	 * AlbumControllers addAction()
	 */
}