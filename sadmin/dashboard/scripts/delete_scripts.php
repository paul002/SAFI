<?php
require_once '../config/dbconn.php';
$db = new db_conn();
$message = "";
$cl="";
$fa = "";

//  Delete Post
if(isset($_POST['postId'])){
  $pid = $_POST['postId'];

  try {
    // Check file to delete
    $fQuery = "SELECT * FROM `posts` WHERE `id` = $pid";
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
        $pQuery = "DELETE FROM `posts` WHERE `id` = $pid";
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
      $pQuery = "DELETE FROM `posts` WHERE `id` = $pid";
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
  } catch (Exception $e) {
    $message = $e->getMessage();
    $cl = "danger";
    $fa = "fa-exclamation-triangle";
  }

  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray); 
}

//  Delete Category
if(isset($_POST['catId'])){
  $catId = $_POST['catId'];
  try {
    $delquery = "DELETE FROM `postcategory` WHERE `id`=$catId";
    $que = $db->query($delquery);
    if($que){
      $message = "Category has been deleted successfully";
      $cl="success";
      $fa = "fa-check";
    }
    else{
      $message = "Error deleting details, kindly try again";
      $cl = "danger";
      $fa = "fa-exclamation-triangle";
    }

  } catch (Exception $e) {
    $message = $e->getMessage();
    $cl = "danger";
    $fa = "fa-exclamation-triangle";
  }

  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray);
}

//  Delete Administration Role
if(isset($_POST['adminId'])){
  $aid = $_POST['adminId'];
  try {
    // Check file to delete
    $fQuery = "SELECT * FROM `administration` WHERE `id` = $aid";
    $fObject = $db->fetchObject($fQuery);
  
    $targetFile = "../../../images/profiles/".$fObject->imagePath;
    $dbFile = $fObject->imagePath;
  
    if($dbFile != ""){
      // Use unlink() function to delete a file
      if (!unlink($targetFile)) {
        $message = "$targetFile cannot be deleted due to an error";
        $cl="danger";
        $fa = "fa-exclamation-triangle";          
      }else {
        $pQuery = "DELETE FROM `administration` WHERE `id` = $aid";
        $que = $db->query($pQuery);
        if($que){
          $message = "Administration role has been deleted successfully";
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
      $pQuery = "DELETE FROM `administration` WHERE `id` = $aid";
      $que = $db->query($pQuery);
      if($que){
        $message = "Administration role has been deleted successfully";
        $cl="success";
        $fa = "fa-check";
      }
      else{
        $message = "Error deleting details, kindly try again";
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
      }        
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
    $cl = "danger";
    $fa = "fa-exclamation-triangle";
  }

  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray); 
}

//  Delete Councillor
if(isset($_POST['councellorId'])){
  $aid = $_POST['councellorId'];
  try {
    // Check file to delete
    $fQuery = "SELECT * FROM `councillors` WHERE `id` = $aid";
    $fObject = $db->fetchObject($fQuery);
  
    $targetFile = "../../../images/profiles/".$fObject->imagePath;
    $dbFile = $fObject->imagePath;
  
    if($dbFile != ""){
      // Use unlink() function to delete a file
      if (!unlink($targetFile)) {
        $message = "$targetFile cannot be deleted due to an error";
        $cl="danger";
        $fa = "fa-exclamation-triangle";          
      }else {
        $pQuery = "DELETE FROM `councillors` WHERE `id` = $aid";
        $que = $db->query($pQuery);
        if($que){
          $message = "Councillor has been deleted successfully";
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
      $pQuery = "DELETE FROM `councillors` WHERE `id` = $aid";
      $que = $db->query($pQuery);
      if($que){
        $message = "Councillor has been deleted successfully";
        $cl="success";
        $fa = "fa-check";
      }
      else{
        $message = "Error deleting details, kindly try again";
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
      }        
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
    $cl = "danger";
    $fa = "fa-exclamation-triangle";
  }

  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray); 
}

//  Delete Contacts
if(isset($_POST['contactId'])){
  $id = $_POST['contactId'];
  try {
    $delquery = "DELETE FROM `contacts` WHERE `id` = $id";
    $que = $db->query($delquery);
    if($que){
      $message = "Contact has been deleted successfully";
      $cl="success";
      $fa = "fa-check";
    }else{
      $message = "Error deleting details, kindly try again";
      $cl = "danger";
      $fa = "fa-exclamation-triangle";
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
  }
  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray);   
}

//  Delete User
if(isset($_POST['userId'])){
  $aid = $_POST['userId'];
  try {
    // Check file to delete
    $fQuery = "SELECT * FROM `users` WHERE `id` = $aid";
    $fObject = $db->fetchObject($fQuery);
  
    $targetFile = "../../../images/profiles/".$fObject->imagePath;
    $dbFile = $fObject->imagePath;
  
    if($dbFile != ""){
      // Use unlink() function to delete a file
      if (!unlink($targetFile)) {
        $message = "$targetFile cannot be deleted due to an error";
        $cl="danger";
        $fa = "fa-exclamation-triangle";          
      }else {
        $pQuery = "DELETE FROM `users` WHERE `id` = $aid";
        $que = $db->query($pQuery);
        if($que){
          $message = "User has been deleted successfully";
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
      $pQuery = "DELETE FROM `users` WHERE `id` = $aid";
      $que = $db->query($pQuery);
      if($que){
        $message = "User been deleted successfully";
        $cl="success";
        $fa = "fa-check";
      }
      else{
        $message = "Error deleting details, kindly try again";
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
      }        
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
    $cl = "danger";
    $fa = "fa-exclamation-triangle";
  }

  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray); 
}

//  Delete User Role
if(isset($_POST['roleId'])){
  $id = $_POST['roleId'];
  try {
    $delquery = "DELETE FROM `roles` WHERE `id` = $id";
    $que = $db->query($delquery);
    if($que){
      $message = "Role has been deleted successfully";
      $cl="success";
      $fa = "fa-check";
    }else{
      $message = "Error deleting details, kindly try again";
      $cl = "danger";
      $fa = "fa-exclamation-triangle";
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
  }
  $responseArray['response'] = array(
    "message" => $message,
    "cl" => $cl,
    "fa" => $fa
  );
  echo json_encode($responseArray);   
}
?>
