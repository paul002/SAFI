<?php
include '../config/dbconn.php';
$db = new db_conn();
$request = 1;
$query = "SELECT * FROM `post_type` ORDER BY `type` ASC";
$row = $db->fetchQuery($query);
$postTypesArray = array();
foreach($row as $postType){
    extract($postType);
    $postRawDate = strtotime($dateCreated);
    $postDateFormatted = date("d/m/Y",$postRawDate);
    // Fetch User
    $uq = "SELECT `id`,`username` FROM `users` WHERE `id`=$createdBy;";
    $uob = $db->fetchObject($uq);

    $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item edit" data-id="'.$id.'" data-catname="'.$type.'" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
        <button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
    </div>';
    $postTypesArray[] = array(
        'id' => $id,
        'type' => $type,
        'createdBy' => $uob->username,
        'dateCreated' => $postDateFormatted,
        'modifiedBy' => $modifiedBy,
        'dateModified' => $dateModified,
        'action' => $buttons
    );
}

    
header("Content-type: application/json");
echo json_encode($postTypesArray);
exit;