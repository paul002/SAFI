<?php
require_once '../config/dbconn.php';
$dbo = new db_conn();

// Response Message Values
$message = "";
$cl = "";
$fa = "";

if (isset($_GET['impactId'])) {
    $id = $_GET['impactId'];
    $que = delete($dbo, $id);
    if ($que) {
        $message = "Impact Area has been Deleted Successfully.";
        $cl = "success";
        $fa = "fa-check";
    } else {
        $message = $que;
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
        $region = $_POST['region'];
        $district = $_POST['districts'];
        $t_a = trim($_POST['ta']);
        $lat = trim($_POST['lat']);
        $lng = trim($_POST['lng']);
        $featuredImage = $_FILES['featuredImage'];
        $content_description = trim($_POST['description']);
        $fileName = "";

        // Form validation
        if ($name == null || $region == 0 || $district == 0 || $t_a == null || $lat == 0 || $lng == 0) {

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
            $path = $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/assets/images/impact areas/";
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
                $que = save($dbo, $name, $region, $district, $t_a, $lat, $lng, $fileName, $content_description);
                if ($que == "OK") {
                    $message = "Impact Area has been Created Successfully.";
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
            $que = update($dbo, $id, $name, $region, $district, $t_a, $lat, $lng, $fileName, $content_description);
            if ($que == "OK") {
                $message = "Impact Area has been Updated Successfully.";
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
        $query = "SELECT `name` FROM `impact_areas` WHERE `name`='$name'";
        $que = $db->fetchQuery($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function save($db, $name, $region, $district, $ta, $lat, $lng, $featImg, $content)
{
    try {
        $query = "INSERT INTO `impact_areas` SET `name`='$name',`region`='$region',`district`='$district',`traditional_authority`='$ta',`lat`='$lat',`lng`='$lng',`featured_image`='$featImg',`content_description`='$content'";
        $que = $db->insert($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update($db, $id, $name, $region, $district, $ta, $lat, $lng, $featImg, $content)
{
    $query = "";
    try {
        if ($featImg != "") {
            $query = "UPDATE `impact_areas` SET `name`='$name',`region`='$region',`district`='$district',`traditional_authority`='$ta',`lat`='$lat',`lng`='$lng',`featured_image`='$featImg',`content_description`='$content' WHERE `id` = $id";
        } else {
            $query = "UPDATE `impact_areas` SET `name`='$name',`region`='$region',`district`='$district',`traditional_authority`='$ta',`lat`='$lat',`lng`='$lng', `content_description`='$content' WHERE `id` = $id";
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
        $fQuery = "SELECT * FROM `impact_areas` WHERE `id` = $id";
        $fObject = $db->fetchObject($fQuery);
        $featImg = $fObject->featured_image;
        $path = $_SERVER['DOCUMENT_ROOT'] . "/safimw.org/assets/images/impact areas/";
        $targetFile = $path . $featImg;

        if ($featImg != "") {
            if (!unlink($targetFile)) {
                return "cannot delete file, check if it exists";
            } else {
                $pQuery = "DELETE FROM `impact_areas` WHERE `id` = $id";
                $que = $db->query($pQuery);
                return $que;
            }
        } else {
            $query = "DELETE FROM `impact_areas`  WHERE `id` = $id";
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
