<?php


namespace Edu\Cnm\DdcAaaa;
use Edu\Cnm\DdcAaaa\{ Application };
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
$requestContent = file_get_contents("php://input");
$decodeContent = json_decode($requestContent, true);


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

if(!empty($newEmail)) {

	$existingApp = Application::getApplicationByApplicationEmail($pdo, $newEmail);
	$existingAbout = $existingApp->getApplicationAboutYou();
	$existingGoals = $existingApp->getApplicationHopeToAccomplish();
	$existingExperience = $existingApp->getApplicationExperience();
	$existingDateTime = $existingApp->getApplicationDateTime();
	if ($existingApp !== null) {

		$query = "UPDATE application SET applicationFirstName = :firstName, applicationLastName = :lastName, applicationPhoneNumber = :phone, applicationSource = :source, applicationAboutYou = :about, applicationHopeToAccomplish = :goals, applicationExperience = :experience WHERE applicationEmail = :email";
		$statement = $pdo->prepare($query);
		$params = [
			"email" => $newEmail,
			"firstName" => $decodeContent["46813104"]["first"],
			"lastName" => $decodeContent["46813104"]["last"],
			"phone" => $decodeContent["46813106"],
			"source" => $decodeContent["46813107"],
			"about" => $decodeContent["46813110"] ."\r\n ********* Previous entry on********* \r\n". $existingAbout,
			"goals" => $decodeContent["46813111"] ."\r\n ********* Previous entry on********* \r\n" . $existingGoals,
			"experience" => $decodeContent["46813112"] ."\r\n ********* Previous entry on********* \r\n". $existingExperience
			];
		$statement->execute($params);
	} else {
		$newApp->insert($pdo);
	}
}





if($decodeContent["46813108"] !== null) {
	if(is_array($decodeContent["46813108"])){
		foreach($decodeContent["46813108"] as &$cohortId){
			$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $cohortId);
			$fd = fopen("/tmp/posttest.txt", "w");
			fwrite($fd, var_export($newAppCohort));
			fclose($fd);
			$newAppCohort->insert($pdo);
		}
	}else{
		$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813108"]);
		$newAppCohort->insert($pdo);
	}
}

if($decodeContent["46813109"] !== null){
	if(is_array($decodeContent["46813109"])){
		foreach($decodeContent["46813109"] as &$cohortId){
			$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $cohortId);
			$newAppCohort->insert($pdo);
		}
	}else{
		$newAppCohort = new ApplicationCohort(null, $newApp->getApplicationId(), $decodeContent["46813109"]);
		$newAppCohort->insert($pdo);
	}
}
