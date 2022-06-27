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
    if ($que) {
        $message = "Vacancy Category has been Deleted Successfully.";
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
        $name = $_POST['name'];
        $description = $_POST['description'];


        // Form validation
        if ($name == null || $name == "") {

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
                $que = save($dbo, $name, $description);
                if ($que == "OK") {
                    $message = "Vacancy Category has been Created Successfully.";
                    $cl = "success";
                    $fa = "fa-check";
                } else {
                    $message = "Error saving details, kindly try again";
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            } else {
                $message = "Category with title '" . $name . "' already exist!";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
        } else {
            // Update                                               
            $que = update($dbo, $id, $name, $description);
            if ($que == 1) {
                $message = "Vacancy Category has been Updated Successfully.";
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
        $query = "SELECT `category` FROM `vacancy_category` WHERE `category`='$name'";
        $que = $db->fetchQuery($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function save($db, $name, $description)
{
    try {
        $query = "INSERT INTO `vacancy_category` SET `category`='$name',`description`='$description'";
        $que = $db->insert($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update($db, $id, $name, $description)
{
    $query = "";
    try {
        $query = "UPDATE `vacancy_category` SET `category`='$name',`description`='$description' WHERE `id` = $id";
        $que = $db->query($query);
        if($que){
            return 1;
        }else{
            return 0;
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function delete($db, $id)
{
    try {
        $query = "DELETE FROM `vacancy_category`  WHERE `id` = $id";
        $que = $db->query($query);
        return $que;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
