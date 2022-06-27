<?php
	//	Delete
	$pId = isset($_GET['del']) ? $_GET['del']: 0;
	if($pId != 0){
		session_start();
		require_once '../config/database.php';
		require_once '../config/dbconn.php';
		$database = new Database();
		$db = $database->connect();
		$db2 = new db_conn();

		// Check file to delete
		$fQuery = "SELECT * FROM `posts` WHERE `id` = $pId";
		$fObject = $db2->fetchObject($fQuery);

		$targetFile = "../../../images/posts/".$fObject->imagePath;
		$dbFile = $fObject->imagePath;

		if($dbFile != ""){
			// Use unlink() function to delete a file
			if (!unlink($targetFile)) {
				$message = "$targetFile cannot be deleted due to an error";
			}else {

				$delQuery = "DELETE FROM `posts` WHERE `id` = $pId";
				$delStmt = $db->prepare($delQuery);

				try {
					$delStmt->execute();
					if($delStmt){

						$_SESSION['delMessage'] = "Post has been deleted successfully!";
						$_SESSION['delSuccess'] = "success";
						header('location: ../posts-page.php');
					}
				} catch (PDOException $e) {
					$errorCode = $e->getCode();
					if($errorCode == 23000){
						$_SESSION['delMessage'] = "<b>Warning <br/>Contact your administrator:</b> - You cannot delete Page in service. Detach from posts first";
						$_SESSION['delSuccess'] = "warning";
						header('location: ../posts-page.php');
					}else{
						$_SESSION['delMessage'] = "<b>Error <br/>Contact your administrator:</b> - ". $e->getMessage();
						$_SESSION['delSuccess'] = "danger";
					}
				}
			}			
		}else{
			$delQuery = "DELETE FROM `posts` WHERE `id` = $cId";
			$delStmt = $db->prepare($delQuery);

			try {
				$delStmt->execute();
				if($delStmt){

					$_SESSION['delMessage'] = "Post has been deleted successfully!";
					$_SESSION['delSuccess'] = "success";
					header('location: ../posts-page.php');
				}
			} catch (PDOException $e) {
				$errorCode = $e->getCode();
				if($errorCode == 23000){
					$_SESSION['delMessage'] = "<b>Warning <br/>Contact your administrator:</b> - You cannot delete Page in service. Detach from posts first";
					$_SESSION['delSuccess'] = "warning";
					header('location: ../posts-page.php');
				}else{
					$_SESSION['delMessage'] = "<b>Error <br/>Contact your administrator:</b> - ". $e->getMessage();
					$_SESSION['delSuccess'] = "danger";
				}
			}			
		}

	}
?>