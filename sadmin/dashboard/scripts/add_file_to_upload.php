<?php
require_once '../config/dbconn.php';
$dbo = new db_conn();

// Response Message Values
$message = "";
$cl = "";
$fa = "";
if (isset($_GET['fileId'])) {

    $id = $_GET['fileId'];
    $que = delete($dbo, $id);
    if ($que) {
        $message = "File has been Deleted Successfully.";
        $cl = "success";
        $fa = "fa-check";
    } else {
        $message = "Failed to Delete File " . $que;
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
        $title = $_POST['title'];
        $category = trim($_POST['category']);
        $description = trim($_POST['description']);
        $fileToUpload = $_FILES['fileToUpload'];
        $fileName = "";
        $fileType = "";

        // Form validation
        if ($title == null || $category == "") {

            $message = "Fields marked with <span class=\"text-danger\">*</span> are mandatory! please fill all the required fields";
            $cl = "danger";
            $fa = "fa-exclamation-triangle";

            $responseArray['response'] = array(
                "message" => $message,
                "cl" => $cl,
                "fa" => $fa
            );

            // header('Content-type:application/json');
            echo json_encode($responseArray);
            exit;
        }

        // Upload File
        if ($fileToUpload['name'] != null && $fileToUpload['error'] != 4) {
            $path = "";
            if ($category == 1)
                $path = $_SERVER['DOCUMENT_ROOT'] . "/safi/assets/images/uploads/home-slider/";
            if ($category == 2)
                $path = $_SERVER['DOCUMENT_ROOT'] . "/safi/assets/images/uploads/gallery/";
            if ($category == 3)
                $path = $_SERVER['DOCUMENT_ROOT'] . "/safi/assets/images/uploads/documents/";
            $status = "";

            // Extract File extension
            $target_file = strtolower(basename($fileToUpload['name']));
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($category != 3) {
                $status = uploadFile($fileToUpload, $path);
            } else {
                $status = uploadDocument($fileToUpload, $path);
            }
            if ($status == "success") {
                $fileName = strtolower('safimw_' . $fileToUpload['name']);
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
            $dup = checkForDuplicates($dbo, $title);
            if (!$dup) {
                //	SAVE RECORD                                                
                $que = save($dbo, $title, $description, $category, $fileName, $fileType);
                if ($que == "OK") {
                    $message = "File has been Uploaded Successfully.";
                    $cl = "success";
                    $fa = "fa-check";
                } else {
                    $message = "Error saving details, kindly try again";
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            } else {
                $message = "File with title '" . $title . "' already exist!";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
        } else {
            // Update                                               
            $que = update($dbo, $id, $name, $content_description, $sDate, $eDate, $category, $sponsor, $fileName);
            if ($que == "OK") {
                $message = "File has been Updated Successfully.";
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
        $query = "SELECT `title` FROM `uploads` WHERE `title`='$name'";
        $que = $db->fetchQuery($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function save($db, $title, $description, $category, $fileName, $fileType)
{
    try {
        $query = "INSERT INTO `uploads` SET `title`='$title',`description`='$description',`category`='$category',`file_path`='$fileName',`file_type`='$fileType'";
        $que = $db->insert($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update($db, $id, $title, $description, $category, $fileName, $fileType)
{
    $query = "";
    try {
        if ($fileName != "") {
            $query = "UPDATE `uploads` SET `title`='$title',`description`='$description',`category`='$category',`file_path`='$fileName',`file_type`='$fileType' WHERE `id` = $id";
        } else {
            $query = "UPDATE `uploads` SET `title`='$title',`description`='$description',`category`='$category' WHERE `id` = $id";
        }
        $que = $db->insert($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function delete($db, $id)
{
    try {
        // Check file to delete
        $fQuery = "SELECT * FROM `uploads` WHERE `id` = $id";
        $fObject = $db->fetchObject($fQuery);
        $ex = "";
        if ($fObject->category == 1)
            $ex = "home-slider";
        if ($fObject->category == 2)
            $ex = "gallery";
        if ($fObject->category == 3)
            $ex = "documents";
        $featImg = $fObject->file_path;
        $path = $_SERVER['DOCUMENT_ROOT'] . "/safi/assets/images/uploads/" . $ex . "/";
        $targetFile = $path . $featImg;

        if ($featImg != "") {
            if (!unlink($targetFile)) {
                return "cannot delete file, check if it exists";
            } else {
                $pQuery = "DELETE FROM `uploads` WHERE `id` = $id";
                $que = $db->query($pQuery);
                return $que;
            }
        } else {
            $query = "DELETE FROM `uploads`  WHERE `id` = $id";
            $que = $db->query($query);
            return $que;
        }
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
function uploadDocument($file, $path)
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
                $errorMsg = "File is an image.";
                $uploadOk = 0;
            } else {
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
                        if ($imageFileType != "pdf") {
                            $errorMsg = "Only PDF files are allowed.";
                            $uploadOk = 0;
                        } else {
                            $uploadOk = 1;
                        }
                    }
                }
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
                    $errorMsg = "Failed to move document";
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
