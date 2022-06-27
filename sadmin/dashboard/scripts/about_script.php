<?php
require_once '../config/dbconn.php';

$dbo = new db_conn();
$createdBy = 1;

$response = array();
$message = "";
$cl = "";
$fa = "";

	$query = "SELECT * FROM `about` WHERE `id` = 1";
	$result = $dbo->fetchQuery($query);
	if (count($result) == 1) {
		$compArray = array();
		$compArray['companyData'] = array();
		foreach($result as $row){
			extract($row);
			$temp = array();
			$temp['id'] = $id; 
			$temp['companyName'] = $companyName; 
			$temp['description'] = $description;
			$temp['address'] = $address;
			$temp['address2'] = $address2;
			$temp['town'] = $town;
			$temp['postalCode'] = $postalCode; 
			$temp['physicalAddress'] = $physicalAddress;
			$temp['latitude'] = $latitude;
			$temp['longitude'] = $longitude; 
			$temp['fax'] = $fax; 
			$temp['mobile'] = $mobile; 
			$temp['phone'] = $phone; 
			$temp['altPhone'] = $altPhone; 
			$temp['email'] = $email;
			$temp['email2'] = $email2;
			$temp['principles'] = $principles; 	
			
			array_push($compArray['companyData'], $temp);
		}
		header("Content-type: application/json");
		echo json_encode($compArray);
	}else{
		header("Content-type: application/json");
		echo json_encode(array('error'=> "only one company is allowed"));
	}


