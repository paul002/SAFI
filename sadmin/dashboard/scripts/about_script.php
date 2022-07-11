<?php
require_once '../config/dbconn.php';

$db = new db_conn();
$createdBy = 1;

$response = array();
$message = "";
$cl = "";
$fa = "";

if (isset($_POST['contactAction'])) {
	$companyId = trim($_POST['companyId']);
	$companyName = trim($_POST['companyName']);
	$email = trim($_POST['email']);
	$email2 = "";
	$phoneNo = trim($_POST['phoneNo']);
	$altPhoneNo = trim($_POST['altPhoneNo']);
	$fax = "";
	$address = trim($_POST['address']);
	$address2 = trim($_POST['address2']);
	$physicalAddress = trim($_POST['physicalAddress']);
	$city = trim($_POST['city']);
	$postalCode = trim($_POST['postalCode']);
	$lat = trim($_POST['lat']);
	$lon = trim($_POST['lon']);
	$facebook = trim($_POST['facebook']);
	$twitter = trim($_POST['twitter']);
	$linkedIn = trim($_POST['linkedIn']);
	$mission = trim($_POST['mission']);
	$vision = trim($_POST['vision']);
	$values = trim($_POST['values']);
	$description = trim($_POST['aboutInfo']);

	// Social Links
	$social_links_media = array(
		"facebook" => $facebook,
		"twitter" => $twitter,
		"linkedIn" => $linkedIn
	);

	$social_links = json_encode($social_links_media);

	// Check if record Exist
	$query = "SELECT * FROM `about`";
	$result = $db->fetchQuery($query);
	if ($result) {
		$que = update($db, $companyId, $companyName, $description, $address, $address2, $city, $postalCode, $physicalAddress, $lat, $lon, $fax, $phoneNo, $altPhoneNo, $email, $email2, $social_links, $mission, $vision, $values);
		if ($que) {
			$message = "Contact Information has been Updated Successfully.";
			$cl = "success";
			$fa = "fa-check";
		} else {
			$message = "Error Updating details, kindly try again";
			$cl = "danger";
			$fa = "fa-exclamation-triangle";
		}
	} else {
		$que = save($db, $companyName, $description, $address, $address2, $city, $postalCode, $physicalAddress, $lat, $lon, $fax, $phoneNo, $altPhoneNo, $email, $email2, $social_links, $mission, $vision, $values);
		if ($que == "OK") {
			$message = "Contact Information has been Added Successfully.";
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
	return;
}

if (isset($_GET['page']) == "about") {
	$query = "SELECT * FROM `about`";
	$result = $db->fetchQuery($query);
	if (count($result) == 1) {
		$compArray = array();
		$compArray['companyData'] = array();
		foreach ($result as $row) {
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
			$temp['phone'] = $phone;
			$temp['altPhone'] = $altPhone;
			$temp['email'] = $email;
			$temp['email2'] = $email2;
			$temp['mission'] = $mission;
			$temp['vision'] = $vision;
			$temp['core_values'] = $core_values;
			$temp['social_media_links'] = $social_links;

			array_push($compArray['companyData'], $temp);
		}
		header("Content-type: application/json");
		echo json_encode($compArray);
	}
}

$responseArray['response'] = array(
	"message" => "Incoming: ",
	"cl" => $cl,
	"fa" => $fa
);

function checkForDuplicates($db, $name)
{
	try {
		$query = "SELECT `companyName` FROM `about` WHERE `companyName`='$name'";
		$que = $db->fetchQuery($query);
		return $que;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}
function save($db, $name, $description, $address, $address2, $town, $postalCode, $physicalAddress, $latitude, $longitude, $fax, $phone, $altPhone, $email, $email2, $social_links, $mission, $vision, $values)
{
	try {
		$query = "INSERT INTO `about` SET `companyName`='$name',`description`='$description',`address`='$address',`address2`='$address2',`town`='$town',`postalCode`='$postalCode',`physicalAddress`='$physicalAddress',`latitude`='$latitude',`longitude`='$longitude',`fax`='$fax',`phone`='$phone',`altPhone`='$altPhone',`email`='$email',`email2`='$email2',`social_links`='$social_links', `mission` ='$mission', `vision`='$vision', `core_values`='$values'";
		// echo $query;
		$que = $db->insert($query);
		return $que;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

function update($db, $id, $name, $description, $address, $address2, $town, $postalCode, $physicalAddress, $latitude, $longitude, $fax, $phone, $altPhone, $email, $email2, $social_links, $mission, $vision, $values)
{
	$query = "";
	try {

		$query = "UPDATE `about` SET `companyName`='$name',`description`='$description',`address`='$address',`address2`='$address2',`town`='$town',`postalCode`='$postalCode',`physicalAddress`='$physicalAddress',`latitude`='$latitude',`longitude`='$longitude',`fax`='$fax',`phone`='$phone',`altPhone`='$altPhone',`email`='$email',`email2`='$email2',`social_links`='$social_links', `mission` ='$mission', `vision`='$vision', `core_values`='$values'  WHERE `id` = $id";
		// echo $query;
		$que = $db->query($query);
		if ($que) {
			return 1;
		} else {
			return 0;
		}
	} catch (Exception $e) {
		return -1;
	}
}

function delete($db, $id)
{
	try {
		// Check file to delete
		$fQuery = "SELECT * FROM `events` WHERE `id` = $id";
		$fObject = $db->fetchObject($fQuery);
		$featImg = $fObject->featured_image;
		$path = $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/assets/images/events/";
		$targetFile = $path . $featImg;

		if ($featImg != "") {
			if (!unlink($targetFile)) {
				return "cannot delete file, check if it exists";
			} else {
				$pQuery = "DELETE FROM `events` WHERE `id` = $id";
				$que = $db->query($pQuery);
				if ($que) {
					return 1;
				} else {
					return 0;
				}
			}
		} else {
			$query = "DELETE FROM `events`  WHERE `id` = $id";
			$que = $db->query($query);
			if ($que) {
				return 1;
			} else {
				return 0;
			}
		}
	} catch (Exception $e) {
		return -1;
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
			$target_file = strtolower($target_dir . 'safimw_' . basename($fileName));


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
					if ($file["size"] > 8000000) {
						$errorMsg = "File size too large (" . $file["size"] . "), upload less than 8MB";
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
				if (!file_exists($path))
					mkdir($path, 0777, true);

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
