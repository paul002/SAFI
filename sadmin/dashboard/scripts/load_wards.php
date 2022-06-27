<?php
include '../config/dbconn.php';
$db = new db_conn();
$request = 1;

$query = "SELECT * FROM `ward` ORDER BY `wardName` ASC";
$row = $db->fetchQuery($query);
$wardsArray['data'] = array();
foreach($row as $ward){
    extract($ward);
    $catRawDate = strtotime($dateCreated);
    $catDateFormatted = date("d/m/Y",$catRawDate);
    // Fetch User
    $uq = "SELECT `id`,`username` FROM `users` WHERE `id`=$createdBy;";
    $uob = $db->fetchObject($uq);

    $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item edit" data-id="'.$id.'" data-wardname="'.$wardName.'" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
        <button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
    </div>';
    $ward = array();
    $ward['id'] = $id;
    $ward['wardName'] = $wardName;
    $ward['createdBy'] = $uob->username;
    $ward['dateCreated'] = $catDateFormatted;
    $ward['modifiedBy'] = $modifiedBy;
    $ward['dateModified'] = $dateModified;
    $ward['action'] = $buttons;

    array_push($wardsArray['data'], $ward);
}

    
header("Content-type: application/json");
echo json_encode($wardsArray);
exit;