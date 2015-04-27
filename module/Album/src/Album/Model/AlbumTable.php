<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

/*
 * For this tutorial, we are going to create a very simple model by creating an AlbumTable class that uses the
 * Zend\Db\TableGateway\TableGateway class in which each album object is an Album object (known as
 * an entity). This is an implementation of the Table Data Gateway design pattern to allow for interfacing with data
 * in a database table. Be aware though that the Table Data Gateway pattern can become limiting in larger sys-
 * tems. There is also a temptation to put database access code into controller action methods as these are exposed
 * by Zend\Db\TableGateway\AbstractTableGateway. Dont do this!
 */
class AlbumTable {

	/*
	 * Theres a lot going on here. Firstly, we set the protected property $tableGateway to the TableGateway instance
	 * passed in the constructor. We will use this to perform operations on the database table for our albums.
	 */
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}

	/*
	 *
	 * We then create some helper methods that our application will use to interface with the table gateway. fetchAll() re-
	 * trieves all albums rows from the database as a ResultSet, getAlbum() retrieves a single row as an Album object,
	 * saveAlbum() either creates a new row in the database or updates a row that already exists and deleteAlbum()
	 * removes the row completely. The code for each of these methods is, hopefully, self-explanatory.
	 *
	 *
	 */
	public function fetchAll() {
		$resultSet = $this->tableGateway->select ();
		return $resultSet;
	}
	public function getAlbum($id) {
		$id = ( int ) $id;
		$rowset = $this->tableGateway->select ( array (
				'id' => $id
		) );
		$row = $rowset->current ();
		if (! $row) {
			throw new \Exception ( "Could not find row $id" );
		}
		return $row;
	}
	public function saveAlbum(Album $album) {
		$data = array (
				'artist' => $album->artist,
				'title' => $album->title
		);

		$id = ( int ) $album->id;
		if ($id == 0) {
			$this->tableGateway->insert ( $data );
		} else {
			if ($this->getAlbum ( $id )) {
				$this->tableGateway->update ( $data, array (
						'id' => $id
				) );
			} else {
				throw new \Exception ( 'Album id does not exist' );
			}
		}
	}
	public function deleteAlbum($id) {
		$this->tableGateway->delete ( array (
				'id' => ( int ) $id
		) );
	}
}