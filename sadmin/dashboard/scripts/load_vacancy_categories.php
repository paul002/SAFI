<?php
require_once '../config/dbconn.php';
$db = new db_conn();
if (isset($_GET['id'])) {
    $category_id = trim($_GET['id']);
    try {
        $category_array = array();
        $category_query = "SELECT * FROM `vacancy_category` WHERE `id` = $category_id";
        $category_obj = $db->fetchObject($category_query);

        $category_array[] = array(
            "id" => $category_obj->id,
            "name" => $category_obj->category,
            "description" => $category_obj->description
        );

        header("Content-type: application/json");
        echo json_encode($category_array);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
} else {
    try {
        $category_array = array();
        $category_query = "SELECT * FROM `vacancy_category`";
        $category_results = $db->fetchQuery($category_query);

        foreach ($category_results as $rec) {
            extract($rec);

            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $category_array[] = array(
                "id" => $id,
                "name" => $category,
                "description" => substr($description, 0, 26) . $isEmptyDesc,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $category_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
