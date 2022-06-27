<?php
	require_once './config/dbconn.php';

	$db = new db_conn();

	// 	Submit Training Details

	if(isset($_POST['submit'])){
		$pid = $db->quote($_POST['id']);
		$programmeName	=	$db->quote($_POST['programmeName']);
		$shortDesc = $db->quote($_POST['shortDesc']);
		$description = $db->quote($_POST['description']);
		// $createdby = 1;

		//confirm existence
		$query = "SELECT * FROM `programmes` WHERE programmeId = $pid";
		$ob = $db->fetchObject($query);

		if($ob && count($ob) > 0){
			$id = $ob->programmeId;
			$query = "UPDATE `programmes` SET `programmeName`=$programmeName,`shortDesc`=$shortDesc,`description`=$description WHERE programmeId = $id";
			$que = $db->query($query);
			$message = "Details successfully updated";
		}else{
			$query = "INSERT INTO `programmes` SET `programmeName`=$programmeName,`shortDesc`=$shortDesc,`description`=$description";
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

	$query = "SELECT * FROM programmes ORDER BY dateCreated DESC";
	$programme = $db->fetchQuery($query);

?>
