<?php

require_once(dirname(__DIR__,2) . "/php/classes/autoload.php");
require_once (dirname(__DIR__,2) . "/php/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\DdcAaaa\Application;
use Edu\Cnm\DdcAaaa\Note;
use Edu\Cnm\DdcAaaa\Cohort;
use Edu\Cnm\DdcAaaa\ApplicationCohort;

/**
 * api for the prospect class
 *
 * @author Kevin Dilts <kevin@kevindilts.net>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {

	// ensure there's a user logged in
//	if(empty($_SESSION["adUser"]) === true) {
//		throw(new RuntimeException("user not logged in", 401));
//	}

	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$noteTypeId = filter_input(INPUT_GET, "noteTypeId", FILTER_VALIDATE_INT);
	$cohortId = filter_input(INPUT_GET, "cohortId", FILTER_VALIDATE_INT);
	//$noteTypeId = 5;
	// handle GET request
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		if(!empty($noteTypeId) && !empty($cohortId)) {

			$applications = [];

			$applicationCohorts = ApplicationCohort::getAllApplicationCohorts($pdo);
			$cohorts = Cohort::getAllCohorts($pdo);
			$notes = Note::getAllNotes($pdo);
			$notes = $notes->toArray();
			if($notes !== null) {
				foreach ($notes as $note) {
					if ($note->noteApplicationId !== null) {
						if ($note->noteNoteTypeId === $noteTypeId) {
							$applications[$note->noteApplicationId] = Application::getApplicationByApplicationId($pdo, $note->noteApplicationId);
						}
					}
				}


				$reply->data = $applications;

			}

		}
		else {
			$reply->data = "nah man...id is null";
		}
	}
	// update reply with exception information
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);