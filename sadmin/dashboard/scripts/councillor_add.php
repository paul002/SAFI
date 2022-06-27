<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

	if(count($_POST) > 0){
		$id = $_POST['id'];
		$firstName = trim($_POST['firstName']);
		$lastName = trim($_POST['lastName']);
		$ward = $_POST['ward'];
		$content = trim($_POST['bioContent']);
		$isActive = isset($_POST['isActive']) ? 1 : 0;
		
		$user = 1;
		if($id == 0){					
			//	SAVE RECORD
			if($_FILES['profilePhoto']['name'] == ""){			
				// Save without Image
					$que = save($dbo, $firstName, $lastName,$ward, $content, $isActive, "", $user);
					if($que == "OK"){
						$message = "Councillor has been created Successfully.";
						$cl = "success";
						$fa = "fa-check";
					}
					else{
						$message = "Error saving details, kindly try again. ".$que;
						$cl = "danger";
						$fa = "fa-exclamation-triangle";
					}
			}else{			
				// Upload Image first
				$path = "../../../images/profiles/";
				$file = $_FILES['profilePhoto'];			
				$msg = uploadFile($file, $path);
				if($msg == "success"){							 	
					$que = save($dbo, $firstName, $lastName,$ward, $content, $isActive, $file['name'], $user);
					if($que == "OK"){
						$message = "Councillor role has been created Successfully.";
						$cl = "success";
						$fa = "fa-check";
					}else{
						$message = "Error saving details, kindly try again";
						$cl = "danger";
						$fa = "fa-exclamation-triangle";
					}	
				}else{
					$message = "Failed to upload image: ".$msg;
					$cl = "warning";
					$fa = "fa-exclamation-triangle";
				}			
			}
		}else{
			// UPDATE RECORD		
			$path = "../../../images/profiles/";
			$file = $_FILES['profilePhoto'];	

			if($_FILES['profilePhoto']['name'] == ""){
				// update without Image					
				$que = update($dbo, $id, $firstName, $lastName, $ward, $content, $isActive, $file['name'], $user);
				if($que){
					$message = "Councillor has been Updated Successfully.";
					$cl = "success";
					$fa = "fa-check";
				}else{
					$message = "Error saving details, kindly try again";
					$cl = "danger";
					$fa = "fa-exclamation-triangle";
				}
			}else{			
				$msg = uploadFile($file,$path);
				if($msg == "success" || $msg == "File already Exists"){
					// DELETE FILE IN FOLDER FIRST
					// Check file to delete
					$fQuery = "SELECT * FROM `councillors` WHERE `id` = $id";
					$fObject = $dbo->fetchObject($fQuery);

					$targetFile = $path.$fObject->imagePath;
					$dbFile = $fObject->imagePath;

					// $message = "Unlink this file [". $dbFile. "] with this message ".$msg;
					// $cl = "danger";

					if($dbFile != ""){
						// Use unlink() function to delete a file
						if (!unlink($targetFile)) {
							$message = "$targetFile Cannot be deleted due to an error. Make sure file exist in the destination folder and try again.";
							$cl = "danger";
							$fa = "fa-exclamation-triangle";
							return;
						}					
					}						
					$que = update($dbo, $id, $firstName, $lastName, $organogram, $content, $isActive, $file['name'], $user);
					if($que){
						$message = "Councillor has been Updated Successfully.";
						$cl = "success";
						$fa = "fa-check";
					}else{
						$message = "Error saving details, kindly try again";
						$cl = "danger";
						$fa = "fa-exclamation-triangle";
					}
				}else{
					$message = "Failed to update record: ".$msg;
					$cl = "danger";
					$fa = "fa-exclamation-triangle";
				}	
			}							
		}
		$responseArray['response'] = array(
			"message" => $message,
			"cl" => $cl,
			"fa" => $fa
		  );

		echo json_encode($responseArray);
		
	}else{
		// Empty Post
		$message = "There is nothing to post";
		$cl = "warning";
		$fa = "fa-exclamation-triangle";

		$responseArray['response'] = array(
			"message" => $message,
			"cl" => $cl,
			"fa" => $fa
		  );

		echo json_encode($responseArray); 	
	}

	function checkForDuplicates($db, $title){
		try{
			$query = "SELECT `title` FROM `posts` WHERE `title`='$title'";
			$que = $db->fetchQuery($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
	function save($db, $firstName, $lastName, $ward, $content, $isActive, $filePath, $user){
		try{
			$query = "INSERT INTO `councillors` SET `firstName` = '$firstName', `lastName`='$lastName', `bio`='$content', `isActive`='$isActive', `imagePath`='$filePath',`wardId`='$ward', `createdBy` = $user, `modifiedBy` = $user, `dateModified` = CURRENT_TIMESTAMP()";
			$que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	function update($db, $id, $firstName, $lastName, $ward, $content, $isActive, $filePath, $user){
		try{
			if($filePath != ""){
				$query = "UPDATE `councillors` SET `firstName` = '$firstName', `lastName`='$lastName', `bio`='$content', `isActive`='$isActive', `imagePath`='$filePath',`wardId`='$ward', `createdBy` = $user, `modifiedBy` = $user, `dateModified` = CURRENT_TIMESTAMP() WHERE `id` = $id";
				$que = $db->query($query);
				$que->execute();
			}else{
				$query = "UPDATE `councillors` SET `firstName` = '$firstName', `lastName`='$lastName', `bio`='$content', `isActive`='$isActive', `wardId`='$ward', `createdBy` = $user, `modifiedBy` = $user, `dateModified` = CURRENT_TIMESTAMP() WHERE `id` = $id";
				$que = $db->query($query);
				$que->execute();
			}
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}

	function uploadFile($file, $path){
		$msg = "";
		try{
			if(isset($file)){
				// Handle File Upload
				$target_dir = $path;
				$fileName = $file["name"];
				$target_file = $target_dir.basename($fileName);
				
	
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
				// Check if image file is a actual image or fake image
				$check = getimagesize($file["tmp_name"]);
				if($check !== false) {
	
					// Check if file already exists
					if (file_exists($target_file)) {
						$msg = "File already Exists";
						$uploadOk = 0;
					}else{
						// Check file size
						if ($file["size"] > 5000000) {
							$msg = "File size too large, upload less than 5MB: ".$file["size"];
							$uploadOk = 0;
						}else{
							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
								$msg = "Only JPG, JPEG, & PNG files are allowed.";
								$uploadOk = 0;
							}else{
								$uploadOk = 1;
							}
						}
					}
				}else {
					$msg = "File is not an image.";
					$uploadOk = 0;
				}
	
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk != 0)  {
					// if everything is ok, try to upload file
					if (move_uploaded_file($file["tmp_name"], $target_file)) {
						$msg = "success";
						$uploadOk = 1;
					}else{
						$msg = "Failed to move image";
						$uploadOk = 0;
					}
	
					return $msg;
				}
				return $msg;
			}
		}catch(Exception $e){
			$msg = $e->errorMessage();
			return $msg;
		}
	}
?>
