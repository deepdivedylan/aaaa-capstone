<?php


require_once("autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * Created by PhpStorm.
 * User: tnpfl
 * Date: 7/13/2017
 * Time: 1:50 PM
 */
Class DataDownloader {

	private $dataset = null;
	public static function getMetaData(string $url){
		$options = [];
		$options["http"] = [];
		$options["http"] ["method"] = "HEAD";
		$context = stream_context_create($options);
		// "@" suppresses warnings and errors, fopen opens the actual file
		$fd = fopen($url, "rb", false, $context);
		$metaData = stream_get_meta_data($fd);
		if($fd === false) {
			throw(new \RuntimeException("unable to open HTTP stream"));
		}
		fclose($fd);
		$header = $metaData["wrapper_data"];

	}
	public function getDatabaseXML($url) {
		$context = stream_context_create(["http" => ["method" => "GET"]]);
		try {
			if((xmlDataBase = file_get_contents($url, null, $context))=== false){
				throw(new \RuntimeException("Cannot connect to xml file"));
			}
			$dataset = simplexml_load_string($xmlDatabase);
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return $dataset;
	}

	public static function insertDatabaseToMySql(\PDO $pdo, \SimpleXMLElement $xmlReader){
		$query="INSERT INTO application (applicationId, applicationFirstName, applicationLastName, applicationEmail, applicationPhoneNumber, applicationSource, applicationAboutYou, applicationHopeToAccomplish, applicationExperience, applicationDateTime, applicationUtmCampaign, applicationUtmMedium, applicationUtmSource) VALUE(:applicationId, :applicationFirstName, :applicationLastName, :applicationEmail, :applicationPhoneNumber, :applicationSource, :applicationAboutYou, :applicationHopeToAccomplish, :applicationExperience, :applicationDateTime, :applicationUtmCampaign, :applicationUtmMedium, :applicationUtmSource)";
		$statement = $pdo->prepare($query);

		while($xmlReader->read() && $xmlReader->name !== "row");

		while($xmlReader->name ==="row"){
			$row = new \SimpleXMLElement($xmlReader->readOuterXML());
			$applicationId = null;
			$applicationFirstName = (string)$row->value[2];
			$applicationLastName = (string)$row->value[1];
			$applicationEmail = (string)$row->value[4];
			$applicationPhoneNumber = (string)$row->value[5];
			$applicationSource = (string)$row->value[9];
			$applicationAboutYou = (string)$row->value[10];
			$applicationHopeToAccomplish = (string)$row->value[11];
			$applicationExperience = (string)$row->value[12];
			$applicationDateTime  = (string)$row->value[13];
			$applicationUtmCampaign = (string)$row->value[1];
			$applicationUtmMedium = (string)$row->value[1];
			$applicationUtmSource = (string)$row->value[1];
		}
}
}
