<?php
	require_once './config/dbconn.php';

	$db = new db_conn();

	// 	Submit Training Details

	if(isset($_POST['submit'])){
		$tid = trim($db->quote($_POST['id']));
		$title	=	$db->quote($_POST['title']);
		$shortDesc = $db->quote($_POST['shortDesc']);
		$date	=	$db->quote($_POST['date']);
		$content = $db->quote($_POST['content']);
		// $createdby = 1;

		//confirm existence
		$query = "SELECT * FROM `news_updates` WHERE `id` = $tid";
		$ob = $db->fetchObject($query);

		if($ob && count($ob) > 0){
			$id = $ob->id;
			$query = "UPDATE `news_updates` SET `title`=$title,`shortDesc`=$shortDesc,`description`=$content,`date`=$date WHERE `id` = $id";
			$que = $db->query($query);
			$message = "Details successfully updated";
		}else{
			$query = "INSERT INTO `news_updates` SET `title`=$title,`shortDesc`=$shortDesc,`description`=$content,`date`=$date";
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

	$query = "SELECT * FROM news_updates ORDER BY dateCreated DESC";
	$newsupdates = $db->fetchQuery($query);

?>
