<?php


namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\Application ;
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$requestContent = file_get_contents("php://input");
$decodeContent = json_decode($requestContent, true);

var_dump($decodeContent);


$decodeContentString = var_export($decodeContent, true);

$fd = fopen("/tmp/posttest2.txt", "w");
fwrite($fd, $decodeContentString);
fclose($fd);
$fd = fopen("/tmp/jsonerror.txt", "w");
fwrite($fd, json_last_error_msg());
fclose($fd);

$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/ddcaaaa.ini");


$newApp = new Application(
	null,
	$decodeContent["46813104"]["first"], //first name
	$decodeContent["46813104"]["last"],//last name
	$decodeContent["46813105"], //email
	$decodeContent["46813106"],//phonenumber
	$decodeContent["46813107"],//source
	$decodeContent["46813110"],//about you
	$decodeContent["46813111"],//hopetoaccomplish
	$decodeContent["46813112"],//experience
	new \DateTime(),
	"empty",
	"empty",
	"empty3"
//$decodeContent["Campaign Term"],
//$decodeContent["Campaign Medium"],
//$decodeContent["Campaign Source"]
);

$newEmail = $decodeContent["46813105"];

//checking the user's email
if(!empty($newEmail)) {

	$existingApp = Application::getApplicationByApplicationEmail($pdo, $newEmail);

	//checking to see if the user is already in the database
	if ($existingApp !== null) {

		//retrieving existing information about applicants from the db
		$existingAppId = $existingApp->getApplicationId();
		$existingAbout = $existingApp->getApplicationAboutYou();
		$existingGoals = $existingApp->getApplicationHopeToAccomplish();
		$existingExperience = $existingApp->getApplicationExperience();
		$existingSource = $existingApp->getApplicationSource();
		$existingDateTime = $existingApp->getApplicationDateTime()->format("Y-m-d H:i:s");
		$newDateTime = new \DateTime();

		//update query for updating the application table when a user submits multiple applications
		$query = "UPDATE application SET applicationFirstName = :firstName, applicationLastName = :lastName, applicationPhoneNumber = :phone, applicationSource = :source, applicationAboutYou = :about, applicationHopeToAccomplish = :goals, applicationExperience = :experience, applicationDateTime = :dateTime WHERE applicationEmail = :email";
		$statement = $pdo->prepare($query);

	   //Checks to see if the user changed anything before updating the database
		if ($existingAbout === $decodeContent["46813110"] || empty($decodeContent["46813110"])) {
			$about = $existingAbout;
		}else {
			$about = $decodeContent["46813110"] ." ********* Previous entry: $existingDateTime ********* ". $existingAbout;
		}
		if ($existingGoals === $decodeContent["46813111"] || empty($decodeContent["46813111"])) {
			$goals = $existingGoals;
		}else {
			$goals = $decodeContent["46813111"] ." ********* Previous entry: $existingDateTime ********* ". $existingGoals;
		}
		if ($existingExperience === $decodeContent["46813112"] || empty($decodeContent["46813112"])) {
			$experience = $existingExperience;
		}else {
			$experience = $decodeContent["46813112"] ." ********* Previous entry: $existingDateTime ********* ". $existingExperience;
		}
		if ($existingSource === $decodeContent["46813107"] || empty($decodeContent["46813107"])) {
			$source = $existingSource;
		}else {
			$source = $decodeContent["46813107"] ." ********* Previous entry: $existingDateTime ********* ". $existingSource;
		}

		//parameters for the update query
		$params = [
			"email" => $newEmail,
			"firstName" => $decodeContent["46813104"]["first"],
			"lastName" => $decodeContent["46813104"]["last"],
			"phone" => $decodeContent["46813106"],
			"source" => $source,
			"about" => $about,
			"goals" => $goals,
			"experience" => $experience,
			"dateTime" => $newDateTime->format("Y-m-d H:i:s")
			];
		$statement->execute($params);
	} else {
		$newApp->insert($pdo);
	}
}

//check for existing applicant
if ($existingApp !== null) {

	//get cohorts applied for by app id. probably an array....
	$existingCohortAppArray = ApplicationCohort::getApplicationCohortsByApplicationId($pdo, $existingAppId);

	//if the user checked a cohort
	if ($decodeContent["46813108"] !== null) {

		//loop through array of existing cohort applications for a given application id
		foreach($existingCohortAppArray as $existingCohortApp) {

			$existingCohortId = $existingCohortApp->getApplicationCohortCohortId();
			if(is_array($decodeContent["46813108"])) {
				foreach($decodeContent["46813108"] as &$cohortId) {
					if ($existingCohortId !== $cohortId) {
						$updateAppCohort = new ApplicationCohort(null, $existingAppId, $cohortId);
						$fd = fopen("/tmp/posttest.txt", "w");
						fwrite($fd, var_export($updateAppCohort));
						fclose($fd);
						$updateAppCohort->insert($pdo);
					}
				}
			} else {
				if ($existingCohortId !== $decodeContent["46813108"]) {
					$updateAppCohort = new ApplicationCohort(null, $existingAppId, $decodeContent["46813108"]);
					$updateAppCohort->insert($pdo);
				}
			}
			if(is_array($decodeContent["46813109"])) {
				foreach($decodeContent["46813109"] as &$cohortId) {
					if ($existingCohortId !== $cohortId) {
						$updateAppCohort = new ApplicationCohort(null, $existingAppId, $cohortId);
						$fd = fopen("/tmp/posttest.txt", "w");
						fwrite($fd, var_export($updateAppCohort));
						fclose($fd);
						$updateAppCohort->insert($pdo);
					}
				}
			} else {
				if ($existingCohortId !== $decodeContent["46813109"]) {
					$updateAppCohort = new ApplicationCohort(null, $existingAppId, $decodeContent["46813109"]);
					$updateAppCohort->insert($pdo);
				}
			}
		}
	}//
}else {
	if($decodeContent["46813108"] !== null) {
		if(is_array($decodeContent["46813108"])) {
			foreach($decodeContent["46813108"] as &$cohortId) {
				$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $cohortId);
				$fd = fopen("/tmp/posttest.txt", "w");
				fwrite($fd, var_export($newAppCohort));
				fclose($fd);
				$newAppCohort->insert($pdo);
			}
		} else {
			$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813108"]);
			$newAppCohort->insert($pdo);
		}
	}

	if($decodeContent["46813109"] !== null) {
		if(is_array($decodeContent["46813109"])) {
			foreach($decodeContent["46813109"] as &$cohortId) {
				$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $cohortId);
				$newAppCohort->insert($pdo);
			}
		} else {
			$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813109"]);
			$newAppCohort->insert($pdo);
		}
	}
}
