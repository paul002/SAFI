<?php
require_once '../config/dbconn.php';

$dbo = new db_conn();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `posts` WHERE `id`= $id";
    $result = $dbo->fetchObject($query);

    $pageArray = array(
        "pageTitle" => $result->title,
        "widgets" => $result->widgets
    );
    header("content-type:application/json");
    echo json_encode($pageArray);
} else {

    $pQuery = "SELECT * FROM `posts`";
    $pArray = $dbo->fetchQuery($pQuery);

    // Fetch Array
    $responseArray = array();
    $responseArray['data'] = array();

    foreach ($pArray as $row) {
        extract($row);

        $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item edit" data-id="' . $id . '" data-label="' . $title . '" data-description="' . $postDescription . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
        <button class="dropdown-item del" data-id="' . $id . '" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
    </div>';

        $pages = array(
            "id" => $id,
            "title" => $title,
            "description" => $postDescription,
            "buttons" => $buttons
        );

        array_push($responseArray['data'], $pages);
    }
    header("content-type:application/json");
    echo json_encode($responseArray);
}
