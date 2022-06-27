<?php
require_once '../config/dbconn.php';

$dbo = new db_conn();


$categoriesArray = array();
$query = "SELECT * FROM `project_category` ORDER BY `id` ASC";
$que = $dbo->fetchQuery($query);
foreach ($que as $row) {
    extract($row);
    $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
    $categoriesArray[] = array(
        'id' => $id,
        'category' => $category,
        'description' => $description,
        'action' => $buttons
    );

}
header('Content-type: application/json');
echo json_encode(array("data" => $categoriesArray));
