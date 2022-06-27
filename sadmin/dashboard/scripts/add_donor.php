<?php
require_once '../config/dbconn.php';
$dbo = new db_conn();

// Response Message Values
$message = "";
$cl = "";
$fa = "";
if (isset($_GET['donorId'])) {

    $id = $_GET['donorId'];
    $que = delete($dbo, $id);
    if ($que == 1) {
        $message = "Donor has been Deleted Successfully.";
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
        $project = trim($_POST['project']);
        $amount = trim($_POST['amount']);
        $fulfilled = isset($_POST['fulfilled']) ? 1 : 0;
        $description = $_POST['description'];

        // Form validation
        if ($name == "" || $project == "") {

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
            $dup = checkForDuplicates($dbo, $name);
            if (!$dup) {
                //	SAVE RECORD                                                
                $que = save($dbo, $name, $description, $project, $amount, $fulfilled);
                if ($que == "OK") {
                    $message = "Donor has been Created Successfully.";
                    $cl = "success";
                    $fa = "fa-check";
                } else {
                    $message = "Error saving details, kindly try again";
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            } else {
                $message = "Donor with title '" . $name . "' already exist!";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
        } else {
            // Update                                               
            $que = update($dbo, $id, $name, $description, $project, $amount, $fulfilled);
            if ($que == 1) {
                $message = "Donor has been Updated Successfully.";
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
        $query = "SELECT `name` FROM `donations` WHERE `name`='$name'";
        $que = $db->fetchQuery($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function save($db, $name, $description, $project, $amount, $fulfilled)
{
    try {
        $query = "INSERT INTO `donations` SET `name`='$name',`description`='$description',`project`='$project',`amount`='$amount',`fulfilled`='$fulfilled'";
        $que = $db->insert($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update($db, $id, $name, $description, $project, $amount, $fulfilled)
{
    try {

        $query = "UPDATE `donations` SET `name`='$name',`description`='$description',`project`='$project',`amount`='$amount',`fulfilled`='$fulfilled'  WHERE `id` = $id";

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

        $query = "DELETE FROM `donations`  WHERE `id` = $id";
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
