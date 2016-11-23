<?php
namespace Edu\Cnm\DdcAaaa\Test;

use Edu\Cnm\DdcAaaa\{
	Application
};

// grab the project test parameters
require_once("AaaaTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");


class ApplicationTest extends AaaaTest {

	protected $VALID_APPLICATIONID = null;

	protected $VALID_APPLICATIONFIRSTNAME = 'Joe';

	protected $VALID_APPLICATIONLASTNAME = 'Shmoe';

	protected $VALID_APPLICATIONEMAIL = "foo@bar.com";

	protected $VALID_APPLICATIONPHONENUMBER = "+12125551212";

	protected $VALID_APPLICATIONSOURCE = 'test';

	protected $VALID_APPLICATIONABOUTYOU = 'test2';

	protected $VALID_APPLICATIONHOPETOACCOMPLISH = 'test3';

	protected $VALID_APPLICATIONEXPERIENCE = 'test4';

	protected $VALID_APPLICATIONDATETIME = null;

	protected $VALID_APPLICATIONUTMCAMPAIGN = 'test5';

	protected $VALID_APPLICATIONUTMMEDIUM = 'test6';

	protected $VALID_APPLICATIONUTMSOURCE = 'test7';





	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();


		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_APPLICATIONDATETIME = new \DateTime();
	}


	/**
	 * test inserting a valid Application and verify that the actual mySQL data matches
	 **/
	public function testInsertValidApplication() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoApplication = Application::getApplicationByApplicationId($this->getPDO(), $application->getApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		$this->assertEquals($pdoApplication->getApplicationId(), $application->getApplicationId());
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONFIRSTNAME);
		$this->assertEquals($pdoApplication->getApplicationLastName(), $this->VALID_APPLICATIONLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationEmail(), $this->VALID_APPLICATIONEMAIL);
		$this->assertEquals($pdoApplication->getApplicationPhoneNumber(), $this->VALID_APPLICATIONPHONENUMBER);
		$this->assertEquals($pdoApplication->getApplicationSource(), $this->VALID_APPLICATIONSOURCE);
		$this->assertEquals($pdoApplication->getApplicationAboutYou(), $this->VALID_APPLICATIONABOUTYOU);
		$this->assertEquals($pdoApplication->getApplicationHopeToAccomplish(), $this->VALID_APPLICATIONHOPETOACCOMPLISH);
		$this->assertEquals($pdoApplication->getApplicationExperience(), $this->VALID_APPLICATIONEXPERIENCE);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), \DateTime::createFromFormat("Y-m-d H:i:s", $application->getApplicationDateTime()));
		$this->assertEquals($pdoApplication->getApplicationUtmCampaign(), $this->VALID_APPLICATIONUTMCAMPAIGN);
		$this->assertEquals($pdoApplication->getApplicationUtmMedium(), $this->VALID_APPLICATIONUTMMEDIUM);
		$this->assertEquals($pdoApplication->getApplicationUtmSource(), $this->VALID_APPLICATIONUTMSOURCE);
	}

	/**
	 * test inserting a Application that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidApplication() {
		// create a Application with a non null application id and watch it fail
		$application = new Application(AaaaTest::INVALID_KEY, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());
	}

	/**
	 * test inserting an Application , editing it, and then updating it
	 **/


	/**
	 * test grabbing a Application by Application content
	 **/
	public function testGetValidApplicationByApplicationId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Application::getApplicationByApplicationId($this->getPDO(), $application->getApplicationId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		$this->assertNotNull($results);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Application", $results);

		// grab the result from the array and validate it
		$pdoApplication = $results;
		$this->assertEquals($pdoApplication->getApplicationId(), $application->getApplicationId());
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONFIRSTNAME);
		$this->assertEquals($pdoApplication->getApplicationLastName(), $this->VALID_APPLICATIONLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationEmail(), $this->VALID_APPLICATIONEMAIL);
		$this->assertEquals($pdoApplication->getApplicationPhoneNumber(), $this->VALID_APPLICATIONPHONENUMBER);
		$this->assertEquals($pdoApplication->getApplicationSource(), $this->VALID_APPLICATIONSOURCE);
		$this->assertEquals($pdoApplication->getApplicationAboutYou(), $this->VALID_APPLICATIONABOUTYOU);
		$this->assertEquals($pdoApplication->getApplicationHopeToAccomplish(), $this->VALID_APPLICATIONHOPETOACCOMPLISH);
		$this->assertEquals($pdoApplication->getApplicationExperience(), $this->VALID_APPLICATIONEXPERIENCE);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), \DateTime::createFromFormat("Y-m-d H:i:s", $application->getApplicationDateTime()));
		$this->assertEquals($pdoApplication->getApplicationUtmCampaign(), $this->VALID_APPLICATIONUTMCAMPAIGN);
		$this->assertEquals($pdoApplication->getApplicationUtmMedium(), $this->VALID_APPLICATIONUTMMEDIUM);
		$this->assertEquals($pdoApplication->getApplicationUtmSource(), $this->VALID_APPLICATIONUTMSOURCE);
	}

	/**
	 * test grabbing a Application by content that does not exist
	 **/
	public function testGetInvalidApplicationByApplicationId() {
		// grab a Application by searching for content that does not exist
		$application = Application::getApplicationByApplicationId($this->getPDO(), AaaaTest::INVALID_KEY);
		$this->assertNull($application);
	}

	public function testGetValidApplicationsByApplicationName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");
		// create a new Swipe and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Application::getApplicationsByApplicationName($this->getPDO(), $application->getApplicationFirstName());
		var_dump($results);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		$this->assertNotNull($results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Application", $results);
		// grab the result from the array and validate it
		$pdoApplication = $results[0];
		$this->assertEquals($pdoApplication->getApplicationId(), $application->getApplicationId());
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONFIRSTNAME);
		$this->assertEquals($pdoApplication->getApplicationLastName(), $this->VALID_APPLICATIONLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationEmail(), $this->VALID_APPLICATIONEMAIL);
		$this->assertEquals($pdoApplication->getApplicationPhoneNumber(), $this->VALID_APPLICATIONPHONENUMBER);
		$this->assertEquals($pdoApplication->getApplicationSource(), $this->VALID_APPLICATIONSOURCE);
		$this->assertEquals($pdoApplication->getApplicationAboutYou(), $this->VALID_APPLICATIONABOUTYOU);
		$this->assertEquals($pdoApplication->getApplicationHopeToAccomplish(), $this->VALID_APPLICATIONHOPETOACCOMPLISH);
		$this->assertEquals($pdoApplication->getApplicationExperience(), $this->VALID_APPLICATIONEXPERIENCE);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), \DateTime::createFromFormat("Y-m-d H:i:s", $application->getApplicationDateTime()));
		$this->assertEquals($pdoApplication->getApplicationUtmCampaign(), $this->VALID_APPLICATIONUTMCAMPAIGN);
		$this->assertEquals($pdoApplication->getApplicationUtmMedium(), $this->VALID_APPLICATIONUTMMEDIUM);
		$this->assertEquals($pdoApplication->getApplicationUtmSource(), $this->VALID_APPLICATIONUTMSOURCE);
	}
	public function testGetInvalidApplicationsByApplicationName() {
		// grab a Application by searching for content that does not exist
		$application = Application::getApplicationsByApplicationName($this->getPDO(), "this doesn't exist");
		$this->assertEmpty($application);
	}

	public function testGetValidApplicationByApplicationEmail() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Application::getApplicationByApplicationEmail($this->getPDO(), $application->getApplicationEmail());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		var_dump($results);
		$this->assertNotNull($results);
		$this->assertInstanceOf("Edu\\Cnm\\DdcAaaa\\Application", $results);

		// grab the result from the array and validate it
		$pdoApplication = $results;
		$this->assertEquals($pdoApplication->getApplicationId(), $application->getApplicationId());
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONFIRSTNAME);
		$this->assertEquals($pdoApplication->getApplicationLastName(), $this->VALID_APPLICATIONLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationEmail(), $this->VALID_APPLICATIONEMAIL);
		$this->assertEquals($pdoApplication->getApplicationPhoneNumber(), $this->VALID_APPLICATIONPHONENUMBER);
		$this->assertEquals($pdoApplication->getApplicationSource(), $this->VALID_APPLICATIONSOURCE);
		$this->assertEquals($pdoApplication->getApplicationAboutYou(), $this->VALID_APPLICATIONABOUTYOU);
		$this->assertEquals($pdoApplication->getApplicationHopeToAccomplish(), $this->VALID_APPLICATIONHOPETOACCOMPLISH);
		$this->assertEquals($pdoApplication->getApplicationExperience(), $this->VALID_APPLICATIONEXPERIENCE);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), \DateTime::createFromFormat("Y-m-d H:i:s", $application->getApplicationDateTime()));
		$this->assertEquals($pdoApplication->getApplicationUtmCampaign(), $this->VALID_APPLICATIONUTMCAMPAIGN);
		$this->assertEquals($pdoApplication->getApplicationUtmMedium(), $this->VALID_APPLICATIONUTMMEDIUM);
		$this->assertEquals($pdoApplication->getApplicationUtmSource(), $this->VALID_APPLICATIONUTMSOURCE);
	}
	public function testGetInvalidApplicationByApplicationEmail() {
		// grab a Application by searching for content that does not exist
		$application = Application::getApplicationByApplicationEmail($this->getPDO(), "this doesn't exist");
		$this->assertEmpty($application);
	}
	/**
	 * test grabbing all ApplicationId
	 **/
	public function testGetAllValidApplications() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("application");

		// create a new Application and insert to into mySQL
		$application = new Application(null, $this->VALID_APPLICATIONFIRSTNAME, $this->VALID_APPLICATIONLASTNAME, $this->VALID_APPLICATIONEMAIL,
			$this->VALID_APPLICATIONPHONENUMBER, $this->VALID_APPLICATIONSOURCE, $this->VALID_APPLICATIONABOUTYOU, $this->VALID_APPLICATIONHOPETOACCOMPLISH, $this->VALID_APPLICATIONEXPERIENCE, $this->VALID_APPLICATIONDATETIME, $this->VALID_APPLICATIONUTMCAMPAIGN, $this->VALID_APPLICATIONUTMMEDIUM, $this->VALID_APPLICATIONUTMSOURCE);
		$application->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Application::getAllApplications($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("application"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DdcAaaa\\Application", $results);

		// grab the result from the array and validate it
		$pdoApplication = $results[0];
		$this->assertEquals($pdoApplication->getApplicationId(), $application->getApplicationId());
		$this->assertEquals($pdoApplication->getApplicationFirstName(), $this->VALID_APPLICATIONFIRSTNAME);
		$this->assertEquals($pdoApplication->getApplicationLastName(), $this->VALID_APPLICATIONLASTNAME);
		$this->assertEquals($pdoApplication->getApplicationEmail(), $this->VALID_APPLICATIONEMAIL);
		$this->assertEquals($pdoApplication->getApplicationPhoneNumber(), $this->VALID_APPLICATIONPHONENUMBER);
		$this->assertEquals($pdoApplication->getApplicationSource(), $this->VALID_APPLICATIONSOURCE);
		$this->assertEquals($pdoApplication->getApplicationAboutYou(), $this->VALID_APPLICATIONABOUTYOU);
		$this->assertEquals($pdoApplication->getApplicationHopeToAccomplish(), $this->VALID_APPLICATIONHOPETOACCOMPLISH);
		$this->assertEquals($pdoApplication->getApplicationExperience(), $this->VALID_APPLICATIONEXPERIENCE);
		$this->assertEquals($pdoApplication->getApplicationDateTime(), \DateTime::createFromFormat("Y-m-d H:i:s", $application->getApplicationDateTime()));
		$this->assertEquals($pdoApplication->getApplicationUtmCampaign(), $this->VALID_APPLICATIONUTMCAMPAIGN);
		$this->assertEquals($pdoApplication->getApplicationUtmMedium(), $this->VALID_APPLICATIONUTMMEDIUM);
		$this->assertEquals($pdoApplication->getApplicationUtmSource(), $this->VALID_APPLICATIONUTMSOURCE);
	}


}