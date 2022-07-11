<?php
require_once '../config/dbconn.php';
$dbo = new db_conn();

// Response Message Values
$message = "";
$cl = "";
$fa = "";
if (isset($_GET['vacancyId'])) {

    $id = $_GET['vacancyId'];
    $que = delete($dbo, $id);
    if ($que == 1) {
        $message = "Vacancy has been Deleted Successfully.";
        $cl = "success";
        $fa = "fa-check";
    } else {
        $message = "Failed to Delete Project " . $que;
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
    $responseArray['response'] = array(
        "message" => $message,
        "cl" => $cl,
        "fa" => $fa
    );
    header('Content-type:application/json');
    echo json_encode($responseArray);
    exit;
} else {

    if (count($_POST) > 0) {
        $id = $_POST['id'];
        $position = $_POST['position'];
        $closing_date = DateTime::createFromFormat('m/d/Y', $_POST['closing_date']);
        $category = trim($_POST['category']);
        $location = trim($_POST['location']);
        $status = isset($_POST['status']) ? 1 : 0;
        $content_description = trim($_POST['description']);
        $cDate = $closing_date->format('Y-m-d');

        // Form validation
        if ($position == null || $closing_date == "") {

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

        if ($id == 0) {
            // Check for duplicates
            $dup = checkForDuplicates($dbo, $position);
            if (!$dup) {
                //	SAVE RECORD                                                
                $que = save($dbo, $position, $content_description, $cDate, $category,$status, $location);
                if ($que == "OK") {
                    $message = "Vacancy has been Created Successfully.";
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
            $que = update($dbo, $id, $position, $content_description, $cDate, $category, $location);
            if ($que == "OK") {
                $message = "Project has been Updated Successfully.";
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
        $query = "SELECT `position` FROM `vacancy` WHERE `position`='$name'";
        $que = $db->fetchQuery($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function save($db, $position, $description, $closing_date, $category,$status,$location)
{
    try {
        $query = "INSERT INTO `vacancy` SET `position`='$position',`closing_date`='$closing_date',`location`='$location',`description`='$description',`category`='$category', `status`='$status'";
        $que = $db->insert($query);
        return $que;
        echo $query;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update($db, $id, $position, $description, $closing_date, $category, $location, $status)
{
    $query = "";
    try {

        $query = "UPDATE `vacancy` SET `position`='$position',`closing_date`='$closing_date',`location`='$location',`description`='$description',`category`='$category', `status`='$status' WHERE `id` = $id";
        $que = $db->query($query);

        if ($que) {
            return 1;
        } else {
            return 0;
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function delete($db, $id)
{
    try {

        $query = "DELETE FROM `vacancy`  WHERE `id` = $id";
        $que = $db->query($query);
        if ($que) {
            return 1;
        } else {
            return 0;
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
