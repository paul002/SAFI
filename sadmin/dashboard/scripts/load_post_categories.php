<?php
include '../config/dbconn.php';
$db = new db_conn();
$request = 1;

$query = "SELECT * FROM `postCategory` ORDER BY `categoryName` ASC";
$row = $db->fetchQuery($query);
$categoryArray = array();
foreach($row as $category){
    extract($category);
    $catRawDate = strtotime($dateCreated);
    $catDateFormatted = date("d/m/Y",$catRawDate);
    // Fetch User
    $uq = "SELECT `id`,`username` FROM `users` WHERE `id`=$createdBy;";
    $uob = $db->fetchObject($uq);

    $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item edit" data-id="'.$id.'" data-catname="'.$categoryName.'" data-description="'.$description.'" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
        <button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
    </div>';
    $categoryArray[] = array(
        'id' => $id,
        'categoryName' => $categoryName,
        'description' => $description,
        'createdBy' => $uob->username,
        'dateCreated' => $catDateFormatted,
        'modifiedBy' => $modifiedBy,
        'dateModified' => $dateModified,
        'action' => $buttons
    );
}

    
header("Content-type: application/json");
echo json_encode($categoryArray);
exit;