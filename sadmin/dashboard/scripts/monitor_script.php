<?php
	// require_once '../config/dbconn.php';

	//$db = new db_conn();

	if(isset($_POST['submit'])){
		$fname=  $db->quote($_POST['firstname']);
		$lname= $db->quote($_POST['lastname']);
		$uname= $db->quote($_POST['username']);
		$pwd= $db->quote($_POST['pwd']);
		$email= $db->quote($_POST['email']);
		$phone= $db->quote($_POST['phone']);
		$altphone= $db->quote($_POST['altPhone']);
		$region= $db->quote($_POST['region']);
		$district= $db->quote($_POST['district']);
		$constituency= $db->quote($_POST['constituency']);
		$ward= $db->quote($_POST['ward']);
		$center= $db->quote($_POST['center']);

		$createdby = 1;

		//confirm existence
		$query = "SELECT * FROM `tally_monitor`";
		$ob = $db->fetchObject($query);
		$mid = $ob->MonitorId;

		if($ob && count($ob) > 0){
			$query = "UPDATE `tally_monitor` SET `firstName`=$fname,`lastName`=$lname,`userName`=$uname,`pwd`=$pwd,`email`=$email,`phoneNo`=$phone,`altPhone` = $altphone ,`RegionId`=$region,`DistrictId`=$district,`ConstituencyId`=$constituency,`WardId`=$ward,`CenterId`=$center,`dateUpdated`=UNIX_TIMESTAMP(),`updatedBy`=$createdby WHERE `MonitorId`=$mid";
			$que = $db->query($query);
			$message = "Details successfully updated";
		}else{
			$query = "UPDATE `tally_monitor` SET `firstName`=$fname,`lastName`=$lname,`userName`=$uname,`pwd`=$pwd,`email`=$email,`phoneNo`=$phone,`altPhone` = $altphone ,`RegionId`=$region,`DistrictId`=$district,`ConstituencyId`=$constituency,`WardId`=$ward,`CenterId`=$center,`DateCreated`=UNIX_TIMESTAMP(),`createdBy`=$createdby";
			$que = $db->insert($query);
			$message = "Details successfully saved";
		}

		//die("There: ".$query);
		if($que){
			$cl = "success";
		}else{
			$message = "Error saving details, kindly try again";
			$cl = "danger";
		}
	}

	$query = "select * from tally_monitor limit 1";
	$monitor = $db->fetchObject($query);

?>
