<?php
    require_once '../config/dbconn.php';
    $db = new db_conn();

    //  Delete Post Image
    if(isset($_POST['remove'])){
        $pid = $_POST['remove'];
        $message = "";

        // Check file to delete
        $fQuery = "SELECT * FROM `posts` WHERE `id` = $pid";
        $fObject = $db->fetchObject($fQuery);

        $targetFile = "../../../images/posts/".$fObject->imagePath;
        $dbFile = $fObject->imagePath;

        if($dbFile != ""){
            // Use unlink() function to delete a file
            if (!unlink($targetFile)) {
                $message = "0";         
            }else {
                $pQuery = "UPDATE `posts` SET `imagePath` = '' WHERE `id` = $pid";
                $que = $db->query($pQuery);
                if($que){
                    $message = "1";
                }
                else{
                    $message = "0";
                }
            }    
        }else{
            $message = "0"; 
        }

        $responseArray['response'] = array(
            "message" => $message
        );
        echo json_encode($responseArray); 
        exit;
    }

    //  Delete Administration Profile Image
    if(isset($_POST['adminProfile'])){
        $aid = $_POST['adminProfile'];
        $message = "";

        // Check file to delete
        $fQuery = "SELECT * FROM `administration` WHERE `id` = $aid";
        $fObject = $db->fetchObject($fQuery);

        $targetFile = "../../../images/profiles/".$fObject->imagePath;
        $dbFile = $fObject->imagePath;

        if($dbFile != ""){
            // Use unlink() function to delete a file
            if (!unlink($targetFile)) {
                $message = "0";         
            }else {
                $pQuery = "UPDATE `administration` SET `imagePath` = '' WHERE `id` = $aid";
                $que = $db->query($pQuery);
                if($que){
                    $message = "1";
                }
                else{
                    $message = "0";
                }
            }    
        }else{
            $message = "0"; 
        }

        $responseArray['response'] = array(
            "message" => $message
        );
        echo json_encode($responseArray); 
        exit;
    }

    //  Delete User Profile Image
    if(isset($_POST['userProfile'])){
        $aid = $_POST['userProfile'];
        $message = "";

        // Check file to delete
        $fQuery = "SELECT * FROM `users` WHERE `id` = $aid";
        $fObject = $db->fetchObject($fQuery);

        $targetFile = "../../../images/profiles/".$fObject->imagePath;
        $dbFile = $fObject->imagePath;

        if($dbFile != ""){
            // Use unlink() function to delete a file
            if (!unlink($targetFile)) {
                $message = "0";         
            }else {
                $pQuery = "UPDATE `users` SET `imagePath` = '' WHERE `id` = $aid";
                $que = $db->query($pQuery);
                if($que){
                    $message = "1";
                }
                else{
                    $message = "0";
                }
            }    
        }else{
            $message = "0"; 
        }

        $responseArray['response'] = array(
            "message" => $message
        );
        echo json_encode($responseArray); 
        exit;
    }
?>
