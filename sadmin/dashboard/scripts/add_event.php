<?php
require_once '../config/dbconn.php';
$dbo = new db_conn();

// Response Message Values
$message = "";
$cl = "";
$fa = "";
if (isset($_GET['eventId'])) {

    $id = $_GET['eventId'];
    $que = delete($dbo, $id);
    if ($que == 1) {
        $message = "Event has been Deleted Successfully.";
        $cl = "success";
        $fa = "fa-check";
    } else {
        $message = "Failed to Delete Event " . $que;
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
    $responseArray['response'] = array(
        "message" => $message,
        "cl" => $cl,
        "fa" => $fa
    );
    // header('Content-type:application/json');
    echo json_encode($responseArray);
    exit;
} else {

    if (count($_POST) > 0) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $start_date = DateTime::createFromFormat('m/d/Y', $_POST['start_date']);
        $end_date = DateTime::createFromFormat('m/d/Y', $_POST['end_date']);
        $location = trim($_POST['location']);
        $featuredImage = $_FILES['featuredImage'];
        $content_description = trim($_POST['description']);
        $fileName = "";
        $sDate = $start_date->format('Y-m-d');
        $eDate = $end_date->format('Y-m-d');

        // Form validation
        if ($name == "" || $start_date == "" || $end_date == "" || $location == "") {

            $message = "Fields marked with <span class=\"text-danger\">*</span> are mandatory! please fill all the required fields";
            $cl = "danger";
            $fa = "fa-exclamation-triangle";

            $responseArray['response'] = array(
                "message" => $message,
                "cl" => $cl,
                "fa" => $fa
            );

            header('Content-type:application/json');
            echo json_encode($responseArray);
            exit;
        }

        // Upload File
        if ($featuredImage['name'] != null && $featuredImage['error'] != 4) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/assets/images/events/";
            $status = uploadFile($featuredImage, $path);
            if ($status == "success") {
                $fileName = strtolower('safimw_' . $featuredImage['name']);
            } else {
                $message = $status;
                $cl = "warning";
                $fa = "fa-exclamation-triangle";

                $responseArray['response'] = array(
                    "message" => $message,
                    "cl" => $cl,
                    "fa" => $fa
                );

                echo json_encode($responseArray);
                exit;
            }
        }

        if ($id == 0) {
            // Check for duplicates
            $dup = checkForDuplicates($dbo, $name);
            if (!$dup) {
                //	SAVE RECORD                                                
                $que = save($dbo, $name, $content_description, $sDate, $eDate, $location, $fileName);
                if ($que == "OK") {
                    $message = "Event has been Created Successfully.";
                    $cl = "success";
                    $fa = "fa-check";
                } else {
                    $message = "Error saving details, kindly try again";
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            } else {
                $message = "Page with title '" . $name . "' already exist!";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
        } else {
            // Update                                               
            $que = update($dbo, $id, $name, $content_description, $sDate, $eDate, $location, $fileName);
            if ($que == 1) {
                $message = "Event has been Updated Successfully.";
                $cl = "success";
                $fa = "fa-check";
            } else {
                $message = "Error Updating details kindly try again";
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
    }
}
function checkForDuplicates($db, $name)
{
    try {
        $query = "SELECT `name` FROM `events` WHERE `name`='$name'";
        $que = $db->fetchQuery($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function save($db, $name, $description, $start_date, $end_date, $location, $featImg)
{
    try {
        $query = "INSERT INTO `events` SET `name`='$name',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`location`='$location',`featured_image`='$featImg'";
        $que = $db->insert($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update($db, $id, $name, $description, $start_date, $end_date, $location, $featImg)
{
    $query = "";
    try {
        if ($featImg != "") {
            $query = "UPDATE `events` SET `name`='$name',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`location`='$location',`featured_image`='$featImg'  WHERE `id` = $id";
        } else {
            $query = "UPDATE `events` SET `name`='$name',`description`='$description',`start_date`='$start_date',`end_date`='$end_date',`location`='$location',`featured_image`='$featImg'  WHERE `id` = $id";
        }
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
