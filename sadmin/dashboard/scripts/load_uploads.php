<?php
require_once '../config/dbconn.php';
$db = new db_conn();
if (isset($_GET['id'])) {
    $category_id = trim($_GET['id']);
    try {
        $uploads_array = array();
        $uploads_query = "SELECT * FROM `uploads` WHERE `category` = $category_id";
        $uploads_results = $db->fetchQuery($uploads_query);

        foreach ($uploads_results as $rec) {
            extract($rec);
            // Fetch Category
            $cQuery = "SELECT * FROM `uploads_category` WHERE `id` = $category";
            $cObj = $db->fetchObject($cQuery);


            $fileExt = $file_type == "pdf" ? '<i class="fas fa-file-pdf fa-lg text-danger"></i>':'<i class="fas fa-image fa-lg text-success"></i>';
            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $uploads_array[] = array(
                "uploads_id" => $id,
                "title" => $title,
                "description" => substr($description, 0, 26) . $isEmptyDesc,
                "category_id" => $category,
                "category" => $cObj->category,
                "filePath" => $file_path,
                "fileType" => $fileExt,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $uploads_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}else{
    try {
        $uploads_array = array();
        $uploads_query = "SELECT * FROM `uploads`";
        $uploads_results = $db->fetchQuery($uploads_query);

        foreach ($uploads_results as $rec) {
            extract($rec);
            // Fetch Category
            $cQuery = "SELECT * FROM `uploads_category` WHERE `id` = $category";
            $cObj = $db->fetchObject($cQuery);


            $fileExt = $file_type == "pdf" ? '<i class="fas fa-file-pdf fa-lg text-danger"></i>':'<i class="fas fa-image fa-lg text-success"></i>';
            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $uploads_array[] = array(
                "uploads_id" => $id,
                "title" => $title,
                "description" => substr($description, 0, 26) . $isEmptyDesc,
                "category_id" => $category,
                "category" => $cObj->category,
                "filePath" => $file_path,
                "fileType" => $fileExt,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $uploads_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
