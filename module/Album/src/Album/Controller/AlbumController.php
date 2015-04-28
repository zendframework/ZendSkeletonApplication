<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album; // <-- Add this import
use Album\Form\AlbumForm;

/*
 * {Controller name}Controller. Note that {Controller name} must start with a capital letter. This class lives in a file called {Controller name}Controller.php within the Controller directory for the module.
 */

/*
 * Note:
 * This is by convention. Zend Framework 2 doesnt provide many restrictions on controllers other
 * than that they must implement the Zend\Stdlib\Dispatchable interface. The framework provides
 * two abstract classes that do this for us: Zend\Mvc\Controller\AbstractActionController
 * and Zend\Mvc\Controller\AbstractRestfulController.
 * Well be using the stan-
 * dard AbstractActionController, but if youre intending to write a RESTful web service,
 * AbstractRestfulController may be useful.
 *
 */
class AlbumController extends AbstractActionController {
	
	/*
	 * You should also add: protected $albumTable; to the top of the class.
	 */
	protected $albumTable;
	
	/*
	 * Each action is a public method within the controller class that is named {action name}Action. In this case {action name} should start with a lower case letter.
	 */

	/*
	 * In order to list the albums, we need to retrieve them from the model and pass them to the view. To do this, we fill in
	 * indexAction() within AlbumController. Update the AlbumControllers indexAction() like this:
	 */
	public function indexAction() {
		return new ViewModel ( array (
				'albums' => $this->getAlbumTable ()->fetchAll () 
		) );
	}
	public function addAction() {
		/*
		 * We instantiate AlbumForm and set the label on the submit button to Add. We do this here as well want to re-use the form when editing an album and will use a different label.
		 */
		$form = new AlbumForm ();
		$form->get ( 'submit' )->setValue ( 'Insert New Album' );
		
		/*
		 * If the Request objects isPost() method is true, then the form has been submitted and so we set the forms input filter from an album instance. We then set the posted data to the form and check to see if it is valid using the isValid() member function of the form.
		 */
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$album = new Album ();
			$form->setInputFilter ( $album->getInputFilter () );
			$form->setData ( $request->getPost () );
			
			/* If the form is valid, then we grab the data from the form and store to the model using saveAlbum(). */
			if ($form->isValid ()) {
				$album->exchangeArray ( $form->getData () );
				$this->getAlbumTable ()->saveAlbum ( $album );
				
				/* After we have saved the new album row, we redirect back to the list of albums using the Redirect controller plugin. */
				// Redirect to list of albums
				return $this->redirect ()->toRoute ( 'album' );
			}
		}
		return array (
				'form' => $form 
		);
	}
	public function editAction() {
		/*
		 * This code should look comfortably familiar. Lets look at the differences from adding an album. Firstly, we look for the id that is in the matched route and use it to load the album to be edited
		 */
		$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'album', array (
					'action' => 'add' 
			) );
		}
		
		// Get the Album with the specified id. An exception is thrown
		// if it cannot be found, in which case go to the index page.
		try {
			$album = $this->getAlbumTable ()->getAlbum ( $id );
		} catch ( \Exception $ex ) {
			return $this->redirect ()->toRoute ( 'album', array (
					'action' => 'index' 
			) );
		}
		/*
		 * params is a controller plugin that provides a convenient way to retrieve parameters from the matched route. We use it to retrieve the id from the route we created in the modules module.config.php. If the id is zero, then we redirect to the add action, otherwise, we continue by getting the album entity from the database. We have to check to make sure that the Album with the specified id can actually be found. If it cannot, then the data access method throws an exception. We catch that exception and re-route the user to the index page.
		 */
		$form = new AlbumForm ();
		
		/*
		 * The forms bind() method attaches the model to the form. This is used in two ways: • When displaying the form, the initial values for each element are extracted from the model. • After successful validation in isValid(), the data from the form is put back into the model. These operations are done using a hydrator object. There are a number of hydrators, but the default one is Zend\Stdlib\Hydrator\ArraySerializable which expects to find two methods in the model: getArrayCopy() and exchangeArray(). We have already written exchangeArray() in our Album entity, so just need to write getArrayCopy():
		 */
		$form->bind ( $album );
		$form->get ( 'submit' )->setAttribute ( 'value', 'Edit' );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$form->setInputFilter ( $album->getInputFilter () );
			$form->setData ( $request->getPost () );
			
			/*
			 * As a result of using bind() with its hydrator, we do not need to populate the forms data back into the $album as thats already been done, so we can just call the mappers saveAlbum() to store the changes back to the database.
			 */
			if ($form->isValid ()) {
				$this->getAlbumTable ()->saveAlbum ( $album );
				
				// Redirect to list of albums
				return $this->redirect ()->toRoute ( 'album' );
			}
		}
		
		return array (
				'id' => $id,
				'form' => $form 
		);
	}
	public function deleteAction() {
		/*
		 * As before, we get the id from the matched route, and check the request objects isPost() to determine whether to show the confirmation page or to delete the album. We use the table object to delete the row using the deleteAlbum() method and then redirect back the list of albums. If the request is not a POST, then we retrieve the correct database record and assign to the view, along with the id.
		 */
		$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'album' );
		}
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$del = $request->getPost ( 'del', 'No' );
			
			if ($del == 'Yes') {
				$id = ( int ) $request->getPost ( 'id' );
				$this->getAlbumTable ()->deleteAlbum ( $id );
			}
			
			// Redirect to list of albums
			return $this->redirect ()->toRoute ( 'album' );
		}
		
		return array (
				'id' => $id,
				'album' => $this->getAlbumTable ()->getAlbum ( $id ) 
		);
	}
	public function debugAction() {
		$obj = new ViewModel ();
		return $obj;
	}
	/*
	 * Now that the ServiceManager can create an AlbumTable instance for us, we can add a method to the controller to retrieve it. Add getAlbumTable() to the AlbumController class
	 */
	public function getAlbumTable() {
		if (! $this->albumTable) {
			$sm = $this->getServiceLocator ();
			$this->albumTable = $sm->get ( 'Album\Model\AlbumTable' );
		}
		return $this->albumTable;
	}
}