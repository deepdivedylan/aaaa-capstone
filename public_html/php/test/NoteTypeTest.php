<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	NoteType
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");


class NoteTypeTest extends AaaaTest {
	/**
	 * content of the NoteType
	 * @var string $VALID_NOTETYPENAME
	 **/
	protected $VALID_NOTETYPENAME = null;
	/**
	 * @var string $VALID_NOTETYPEID
	 */
	protected $VALID_NOTETYPEID = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a profile to own the test Application
		$this->noteType = new NoteTypeName(null, 0);
		$this->noteType->insert(this->getPDO());
	}
	/**
	 * test inserting a valid NoteType and verify that the actual mySQL data matches
	 **/
	public function testInsertValidNoteTypeName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("notetype"); //What does this do? -Trevor

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->noteType->getNoteTypeName(), $this->VALID_NOTETYPEID);
		$noteType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoNoteType = NoteType::getNoteTypeByNoteTypeId($this->getPDO(), $noteType->getNoteTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		//$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->VALID_NOTETYPENAME0;
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->noteType->getNoteTypeId());
		$this->assertEquals($pdoNoteType->getNoteTypeId(), $this->VALID_NOTETYPEID);
	}

	/**
	 * test inserting a NoteType that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidNoteType() {
		// create a NoteType with a non null NoteTypeName and watch it fail
		$noteType = new NoteType(AaaaTest::INVALID_KEY, $this->noteType->getNoteTypeName(), $this->VALID_NOTETYPEID);
		$noteType->insert($this->getPDO());
	}

	/**
	 * test inserting a NoteType, editing it, and then updating it
	 **/
	public function testUpdateValidNoteType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType");

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->noteType->getNoteTypeName(), $this->VALID_NOTETYPENAME);
		$noteType->insert($this->getPDO());

		// edit the NoteType and update it in mySQL
		$noteType->setNoteType($this->VALID_NOTETYPENAME);
		$noteType->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$result = NoteType::getNoteTypeByNoteTypeId($this->getPDO(), $noteType->getNoteTypeId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		$this->assertNotNull($result);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\NoteType", $result);
		// grab the result from the array and validate it
		$this->noteType->getNoteTypeId());
		$this->assertEquals($result->getNoteTypeName(), $this->noteType-getNoteTypeName());
		$this->assertEquals($result->getNoteTypeId->getnoteType(), $this->VALID_NOTETYPEID);
	}

	/**
	 * test updating a NoteType that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidNoteType() {
		// create a NoteType, try to update it without actually updating it and watch it fail
		$noteType = new NoteType(null, $this->noteType->getNoteTypeId->getNoteTypeId(), $this->VALID_NOTETYPENAME, $this->VALID_NOTETYPEID);
		$noteType->update($this->getPDO());
	}

	/**
	 * test grabbing all NoteType
	 **/
	public function testGetAllValidNoteType() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("noteType");

		// create a new NoteType and insert to into mySQL
		$noteType = new NoteType(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$noteType->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getAllNoteTypes($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("noteType"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\EduCnm\\NoteType", $results);

		// grab the result from the array and validate it
		$pdoNoteType = $results[0];
		$this->assertEquals($pdoNoteType->getNoteTypeName(), $this->profile->getNoteTypeId());
		$this->assertEquals($pdoNoteType>getNoteTypeName(), $this->VALID_NOTETYPENAME);
		$this->assertEquals($pdoNoteType->getNoteTypeId(), $this->VALID_NOTETYPEID);
	}
}