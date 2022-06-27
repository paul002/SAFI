<?php

	//	Delete
	$cId = isset($_GET['del']) ? $_GET['del']: 0;
	if($cId != 0){
		session_start();
		require_once '../config/database.php';
		$database = new Database();
		$db = $database->connect();

		$delQuery = "DELETE FROM `pages` WHERE `pageId` = $cId";
		$delStmt = $db->prepare($delQuery);

		try {
			$delStmt->execute();
			if($delStmt){
				$_SESSION['delMessage'] = "Page has been deleted successfully!";
				$_SESSION['delSuccess'] = "success";
				header('location: ../pages_list.php');
			}
		} catch (PDOException $e) {
			$errorCode = $e->getCode();
			if($errorCode == 23000){
				$_SESSION['delMessage'] = "<b>Warning <br/>Contact your administrator:</b> - You cannot delete Page in service. Detach from menu first";
				$_SESSION['delSuccess'] = "warning";
				header('location: ../pages_list.php');
			}else{
				$_SESSION['delMessage'] = "<b>Error <br/>Contact your administrator:</b> - ". $e->getMessage();
				$_SESSION['delSuccess'] = "danger";
			}
		}
	}else{
		require_once 'config/database.php';
		require_once 'config/dbconn.php';

		$database = new Database();
		$db = $database->connect();

		//$db = new db_conn();
		if(isset($_POST['save'])){
			$id = $_POST['id'];
			$pageTitle=  trim($_POST['pageTitle']);
			$alias= trim($_POST['alias']);
			$pageDescription = trim($_POST['pdescription']); // Page description
			$description = trim($_POST['description']); // content
			$meta_keywors = trim($_POST['meta_keywords']);
			$meta_description = trim($_POST['meta_description']);
			$isActive = isset($_POST['isActive']) ? 1 : 0;

			// Widgets Variables
			$enableSidebar = isset($_POST['isSidebar']) ? 1 : 0;
			$enableSearch = isset($_POST['isSearchForm']) ? 1 : 0;
			$enableSideMenu = isset($_POST['isSideMenu']) ? 1 : 0;
			$enableSocialLinks = isset($_POST['isSocialLinks']) ? 1 : 0;
			if($enableSidebar == 1 && $enableSearch == 0 || $enableSideMenu == 0 || $enableSocialLinks == 0){
				$message = "<i class=\"fas fa-exclamation-triangle\"></i><b> Warning:</b> Please Select one of the Widgets to proceed";
				$cl = "warning";
			}else{
				if ($id == 0) {
					//	Create
					$createdby = $userId;

					$query = "INSERT INTO `pages` SET `title`='$pageTitle',`description` = '$pageDescription',`content`='$description',`meta_tag`='$meta_keywors',`meta_description`='$meta_description',`alias`='$alias',`isActive`='$isActive',`isSidebar`='$enableSidebar',`isSideMenu`='$enableSideMenu',`isSearchForm`='$enableSearch',`isSocialLinks`='$enableSocialLinks', `createdBy` = $createdby";
					$que = $db->prepare($query);
					$que->execute();
					if($que){
						$message = "Page Created successfully!";
						$cl = "success";
					}else{
						$message = "Error saving details, kindly try again";
						$cl = "danger";
					}
				}else{
					//	Update
					$modifiedby = $userId;

					$query = "UPDATE `pages` SET `title`='$pageTitle',`description` = '$pageDescription',`content`='$description',`meta_tag`='$meta_keywors',`meta_description`='$meta_description',`alias`='$alias',`isActive`='$isActive', `isSidebar`='$enableSidebar',`isSideMenu`='$enableSideMenu',`isSearchForm`='$enableSearch',`isSocialLinks`='$enableSocialLinks', `modifiedBy` = $modifiedby, `modifiedDate`=CURRENT_TIMESTAMP() WHERE pageId = $id";
					$que = $db->prepare($query);
					$que->execute();
					if($que){
						$message = "Page Updated successfully!";
						$cl = "success";
					}else{
						$message = "Error saving details, kindly try again";
						$cl = "danger";
					}
				}
			}
		}
	}
?>
