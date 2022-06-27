<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

	if(count($_POST) > 0){
		$id = $_POST['id'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $phoneNo = $_POST['phoneNo']; 
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $role = $_POST['userRole'];
        $userStatus = isset($_POST['isActive']) ? 1 : 0;
        $imagePath = $_FILES['imageFile'];
		
		$user = 1;
		if($id == 0){					
			//	SAVE RECORD
			if($_FILES['imageFile']['name'] == ""){
				// Check if username exist
				$result = checkForDuplicates($dbo, $username, $email);
				if(!empty($result)){
					$message = "User [".$username."] Already Exists.";
					$cl = "success";
					$fa = "fa-check";
				}else{
				// Save without Image
					$que = save($dbo, $firstName, $lastName, $middleName, $username,$password,$email,$phoneNo,$role, $userStatus, '', $user);
					if($que == "OK"){
						$message = "User has been created Successfully.";
						$cl = "success";
						$fa = "fa-check";
					}
					else{
						$message = "Error saving details, kindly try again. ".$que;
						$cl = "danger";
						$fa = "fa-exclamation-triangle";
					}
				}
			}else{			
				// Upload Image first
				$path = "../../../images/profiles/";
				$file = $_FILES['imageFile'];			
				$msg = uploadFile($file, $path);
				if($msg == "success"){							 	
					$que = save($dbo, $firstName, $lastName, $middleName, $username,$password,$email,$phoneNo,$role, $userStatus, $file['name'], $user);
					if($que == "OK"){
						$message = "User has been created Successfully.";
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
			$file = $_FILES['imageFile'];	

			if($_FILES['imageFile']['name'] == ""){
				// update without Image					
				$que = update($dbo, $id, $firstName, $lastName, $middleName, $username,$password,$email,$phoneNo,$role, $userStatus, '', $user);
				if($que){
					$message = "User has been Updated Successfully.";
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
					$fQuery = "SELECT * FROM `users` WHERE `id` = $id";
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
					$que = update($dbo, $id, $firstName, $lastName, $middleName, $username,$password,$email,$phoneNo,$role, $userStatus, $file['name'], $user);
					if($que){
						$message = "User has been Updated Successfully.";
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

	function checkForDuplicates($db, $username, $email){
		try{
			$query = "SELECT `username` FROM `users` WHERE `username`='$username' OR `email` = '$email'";
			$que = $db->fetchQuery($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
	function save($db, $firstName, $lastName, $middleName, $username,$password,$email,$phoneNo,$role, $userStatus, $imagePath, $user){
		try{
			$query = "INSERT INTO `users` SET `username`='$username',`password`='$password',`email`='$email',`phoneNo`='$phoneNo',`firstName`='$firstName',`middleName`='$middleName',`lastName`='$lastName',`roleId` = '$role',`status`='$userStatus',`imagePath`='$imagePath',`createdBy`='$user',`modifiedBy`='$user', `dateModified` = CURRENT_TIMESTAMP()";
			$que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	function update($db, $id, $firstName, $lastName, $middleName, $username,$password,$email,$phoneNo,$role, $userStatus, $imagePath, $user){
		try{
            $setImageFile = "";
            if(empty($imagePath)){
                $setImageFile = "`imagePath`=''";
            }else{
                $setImageFile = "`imagePath`='$imagePath'";
            }
            $query = "UPDATE `users` SET `username`='$username', `email`='$email',`phoneNo`='$phoneNo',`firstName`='$firstName',`middleName`='$middleName',`lastName`='$lastName',`roleId` = '$role',`status`='$userStatus',".$setImageFile.",`modifiedBy`='$user', `dateModified` = CURRENT_TIMESTAMP() WHERE `id` = $id";
            $que = $db->query($query);
            $que->execute();
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
