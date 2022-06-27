<?php
	require_once './config/dbconn.php';

	$db = new db_conn();

	// 	Submit Home Details

	if(isset($_POST['submit'])){

		$id = $db->quote($_POST['homeId']);
		$downloads =  isset($_POST['chkDownloads']) ? 1 : 0;
		$localeInfo	=	isset($_POST['chkLocaleInfo']) ? 1 : 0;
		$gallery = isset($_POST['chkGallery']) ? 1 : 0;
		$notices		=	isset($_POST['chkNotices']) ? 1 : 0;
		$sideImage	=	isset($_POST['chkSideImage']) ? 1 : 0;
		$upcomingEvents = isset($_POST['chkUpcomingEvents']) ? 1 : 0;
		$directory = isset($_POST['chkDirectory']) ? 1 : 0;
		// $createdby = 1;

		//confirm existence
		$query = "SELECT DISTINCT * FROM `home` WHERE `id` = $id";
		$ob = $db->fetchObject($query);

		if($ob){
			$id = $ob->id;
			$query = "UPDATE `home` SET `showNotices`='$notices',`showDocuments`='$downloads',`showLocationInfo`='$localeInfo',`showGallery`='$gallery',`showUpcomingEvents`='$upcomingEvents',`showAdImg`='$sideImage',`showInterests`='$directory',`modifiedBy`='1',`dataModified`= CURRENT_TIMESTAMP() WHERE `id` = $id";

			$que = $db->query($query);
			$message = "Home Features Saved successfully";
		}

		if($que){
			$cl = "success";
		}else{
			$message = "Error saving details, kindly try again";
			$cl = "danger";
		}
	}

	if(isset($_POST['callToAction'])){
		$id = $db->quote($_POST['homeId']);
		$title = $db->quote($_POST['title']);
		$shortDesc = $db->quote($_POST['shortDesc']);

		//confirm existence
		$query = "SELECT DISTINCT * FROM `home` WHERE `id` = $id";
		$ob = $db->fetchObject($query);

		if($ob){
			$id = $ob->id;
			$query = "UPDATE `home` SET `title`=$title,`shortDesc`=$shortDesc,`modifiedBy`='1',`dataModified`= CURRENT_TIMESTAMP() WHERE `id` = $id";

			$que = $db->query($query);
			$message = "Home Features Saved successfully";
		}

		if($que){
			$cl = "success";
		}else{
			$message = "Error saving details, kindly try again";
			$cl = "danger";
		}		
	}

	$query = "SELECT * FROM `home`";
	$home = $db->fetchObject($query);

?>
