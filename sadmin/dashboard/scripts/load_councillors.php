<?php
include '../config/dbconn.php';
$db = new db_conn();
$request = 1;

$query = "SELECT * FROM `councillors` ORDER BY `dateCreated` ASC";
$row = $db->fetchQuery($query);
$councillorsArray = array();
$councillorsArray['data'] = array();
foreach($row as $councillor){
    extract($councillor);

    $catRawDate = strtotime($dateCreated);
    $catDateFormatted = date("d/m/Y",$catRawDate);

    // Fetch User
    $uq = "SELECT `id`,`username` FROM `users` WHERE `id`=$createdBy;";
    $uob = $db->fetchObject($uq);
    // print_r($uob);

    // ward data
    $cq = "SELECT `id`,`wardName` FROM `ward` WHERE `id` = $wardId";
    $cObj = $db->fetchObject($cq);

    $status = $isActive == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';

    //  check if image exist
    $profileImage = $imagePath == ""?"../../images/profiles/empty.png" :"../../images/profiles/".$imagePath;
    $photoPlaceholder = '<div><img src="'.$profileImage.'" class="rounded-circle" alt="Cinque Terre" width="60" height="60"> </div>';
    $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item edit" data-id="'.$id.'" data-fname="'.$firstName.'" data-lname="'.$lastName.'" data-bio="'.$bio.'" data-isactive="'.$isActive.'" data-image="'.$imagePath.'" data-wid="'.$wardId.'" data-wardname="'.$cObj->wardName.'" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
        <button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
    </div>';
     $dataArray = array();
     $dataArray['id'] = $id;
     $dataArray['photo'] = $photoPlaceholder;
     $dataArray['firstName'] = $firstName;
     $dataArray['lastName'] = $lastName;
     $dataArray['ward'] = $cObj->wardName;
     $dataArray['isActive'] =$status;
     $dataArray['createdBy'] = $uob->username;
     $dataArray['dateCreated'] = $catDateFormatted;
     $dataArray['modifiedBy'] = $modifiedBy;
     $dataArray['dateModified'] = $dateModified;
     $dataArray['action'] = $buttons;
    array_push($councillorsArray['data'],$dataArray);
}

    
header("Content-type: application/json");
echo json_encode($councillorsArray);
exit;