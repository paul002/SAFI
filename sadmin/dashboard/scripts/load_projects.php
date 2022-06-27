<?php
require_once '../config/dbconn.php';
$db = new db_conn();
if (isset($_GET['id'])) {
    $project_id = trim($_GET['id']);
    try {
        $project_array = array();
        $project_query = "SELECT * FROM `projects` WHERE `id` = $project_id";
        $project_obj = $db->fetchObject($project_query);

        // Fetch Category
        $cQuery = "SELECT * FROM `project_category` WHERE `id` = $project_obj->category";
        $cObj = $db->fetchObject($cQuery);

        $project_array[] = array(
            "project_id" => $project_obj->id,
            "name" => $project_obj->name,
            "description" => $project_obj->description,
            "start_date" => date('d/m/Y',strtotime($project_obj->start_date)),
            "end_date" => date('d/m/Y',strtotime($project_obj->end_date)),
            "category_id" => $cObj->id,
            "category" => $cObj->category,
            "sponsor" => $project_obj->sponsor,
            "featImg" => $project_obj->featured_image
        );

        header("Content-type: application/json");
        echo json_encode($project_array);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
} else {
    try {
        $project_array = array();
        $project_query = "SELECT * FROM `projects`";
        $project_results = $db->fetchQuery($project_query);

        foreach ($project_results as $rec) {
            extract($rec);

            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $project_array[] = array(
                "project_id" => $id,
                "name" => $name,
                "description" => substr($description, 0, 26).$isEmptyDesc,
                "start_date" => date('d/m/Y',strtotime($start_date)),
                "end_date" => date('d/m/Y',strtotime($end_date)),
                "category" => $category,
                "sponsor" => $sponsor,
                "featImg" => $featured_image,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $project_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
