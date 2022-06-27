<?php
require_once '../config/dbconn.php';
$dbo = new db_conn();

if (count($_POST) > 0) {
	$id = $_POST['id'];
	$postType = $_POST['postType'];
	$title = trim($_POST['postTitle']);
	$description = trim($_POST['postDescription']);
	$meta_key = trim($_POST['metakey']);
	$meta_value = trim($_POST['metavalue']);
	$sidebar = isset($_POST['sidebar']) ? 1 : 0;

	// Widgets
	$about = isset($_POST['about']) ? 1 : 0;
	$events = isset($_POST['events']) ? 1 : 0;
	$services = isset($_POST['services']) ? 1 : 0;
	$video = isset($_POST['video']) ? 1 : 0;
	$published = isset($_POST['isPublished']) ? 1 : 0;
	$widgetsArray = array();
	$widgetsArray['data'] = array();
	$wArray = array();
	$wArray['about'] = $about;
	$wArray['events'] = $events;
	$wArray['services'] = $services;
	$wArray['video'] = $video;
	array_push($widgetsArray['data'], $wArray);
	$widgets = json_encode($widgetsArray);
	// Content
	$content = trim($_POST['pageContent']);


	// Response Message Values
	$message = "";
	$cl = "";
	$fa = "";

	$user = 1;
	if ($id == 0) {
		// Check for duplicates
		$dup = checkForDuplicates($dbo, $title);
		if (!$dup) {
			//	SAVE RECORD
			$que = save($dbo, $postType, $title, $description, $meta_key, $meta_value, $content, $sidebar, $widgets, $published, $user);
			if ($que == "OK") {
				$message = "Page has been Created Successfully.";
				$cl = "success";
				$fa = "fa-check";
			} else {
				$message = "Error saving details, kindly try again";
				$cl = "danger";
				$fa = "fa-exclamation-triangle";
			}
		} else {
			$message = "Page with title '".$title."' already exist!";
			$cl = "warning";
			$fa = "fa-exclamation-triangle";
		}
	} else {
		// UPDATE RECORD			
		$que = update($dbo, $id, $postType, $title, $description, $meta_key, $meta_value, $content, $sidebar, $widgets, $published, $user);
		if ($que) {
			$message = "Page has been Updated Successfully.";
			$cl = "success";
			$fa = "fa-check";
		} else {
			$message = "Error saving details, kindly try again";
			$cl = "danger";
			$fa = "fa-exclamation-triangle";
		}
	}

	$responseArray['response'] = array(
		"message" => $message,
		"cl" => $cl,
		"fa" => $fa
	);

	echo json_encode($responseArray);
} else {
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

function checkForDuplicates($db, $title)
{
	try {
		$query = "SELECT `title` FROM `posts` WHERE `title`='$title'";
		$que = $db->fetchQuery($query);
		return $que;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}
function save($db, $postType, $title, $description, $meta_key, $meta_value, $content, $sidebar, $widgetsArray, $isPublished, $user)
{
	try {
		$query = "INSERT INTO `posts` SET `title`='$title',`postDescription`='$description',`content`='$content',`post_type`='$postType',`widgets`='$widgetsArray',`isPublished`='$isPublished',`meta_key`='$meta_key',`meta_value`='$meta_value',`side_bar`='$sidebar',`parent`='',`createdBy`='$user',`dateCreated`=CURRENT_TIMESTAMP(),`modifiedBy`='$user',`dateModified`=CURRENT_TIMESTAMP()";
		$que = $db->insert($query);
		return $que;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

function update($db, $id, $postType, $title, $description, $meta_key, $meta_value, $content, $sidebar, $widgetsArray, $isPublished, $user)
{
	try {
		$query = "UPDATE `posts` SET `title`='$title',`postDescription`='$description',`content`='$content',`post_type`='$postType',`widgets`='$widgetsArray',`isPublished`='$isPublished',`meta_key`='$meta_key',`meta_value`='$meta_value',`side_bar`='$sidebar',`parent`='',`createdBy`='$user',`dateCreated`=CURRENT_TIMESTAMP(),`modifiedBy`='$user',`dateModified`=CURRENT_TIMESTAMP() WHERE `id` = $id";
		$que = $db->query($query);
		$que->execute();

		return $que;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

function uploadFile($file, $path)
{
	$errorMsg = "";
	try {
		if (isset($file)) {
			// Handle File Upload
			$target_dir = $path;
			$fileName = $file["name"];
			$target_file = $target_dir . basename($fileName);


			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			$check = getimagesize($file["tmp_name"]);
			if ($check !== false) {

				// Check if file already exists
				if (file_exists($target_file)) {
					$errorMsg = "File already Exists";
					$uploadOk = 0;
				} else {
					// Check file size
					if ($file["size"] > 500000) {
						$errorMsg = "File size too large, upload less than 5MB";
						$uploadOk = 0;
					} else {
						// Allow certain file formats
						if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
							$errorMsg = "Only JPG, JPEG, & PNG files are allowed.";
							$uploadOk = 0;
						} else {
							$uploadOk = 1;
						}
					}
				}
			} else {
				$errorMsg = "File is not an image.";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk != 0) {
				// if everything is ok, try to upload file
				if (move_uploaded_file($file["tmp_name"], $target_file)) {
					$errorMsg = "success";
					$uploadOk = 1;
				} else {
					$errorMsg = "Failed to move image";
					$uploadOk = 0;
				}

				return $errorMsg;
			}
			return $errorMsg;
		}
	} catch (Exception $e) {
		$errorMsg = $e->getMessage();
		return $errorMsg;
	}
}
