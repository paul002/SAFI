<?php
require_once '../config/dbconn.php';
$db = new db_conn();
//$dbRaw = $database->connect();

//  Delete Post
if(isset($_POST['postId'])){
  $pid = $_POST['postId'];
  $message = "";
  $cl="";
  $fa = "";

  // Check file to delete
  $fQuery = "SELECT * FROM `post_archive` WHERE `id` = $pid";
  $fObject = $db->fetchObject($fQuery);

  $targetFile = "../../../images/posts/".$fObject->imagePath;
  $dbFile = $fObject->imagePath;

  if($dbFile != ""){
    // Use unlink() function to delete a file
    if (!unlink($targetFile)) {
      $message = "$targetFile cannot be deleted due to an error";
      $cl="danger";
      $fa = "fa-exclamation-triangle";          
    }else {
      $pQuery = "DELETE FROM `post_archive` WHERE `id` = $pid";
      $que = $db->query($pQuery);
      if($que){
        $message = "Post has been deleted successfully";
        $cl="success";
        $fa = "fa-check";
      }
      else{
        $message = "Error deleting details, kindly try again";
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
      }
    }    
  }else{
    $pQuery = "DELETE FROM `post_archive` WHERE `id` = $pid";
    $que = $db->query($pQuery);
    if($que){
      $message = "Post has been deleted successfully";
      $cl="success";
      $fa = "fa-check";
    }
    else{
      $message = "Error deleting details, kindly try again";
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
?>
