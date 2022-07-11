<?php
require_once '../config/dbconn.php';
$db = new db_conn();
if (isset($_GET['id'])) {
    $vacancy_id = trim($_GET['id']);
    try {
        $vacancy_array = array();
        $vacancy_query = "SELECT * FROM `vacancy` WHERE `id` = $vacancy_id";
        $vacancy_obj = $db->fetchObject($vacancy_query);

        // Fetch Category
        $cQuery = "SELECT * FROM `vacancy_category` WHERE `id` = $vacancy_obj->category";
        $cObj = $db->fetchObject($cQuery);

        $vacancy_array[] = array(
            "vacancy_id" => $vacancy_obj->id,
            "position" => $vacancy_obj->position,
            "description" => $vacancy_obj->description,
            "closing_date" => date('d/m/Y', strtotime($vacancy_obj->closing_date)),
            "category_id" => $cObj->id,
            "category" => $cObj->category,
            "status" => $vacancy_obj->status,
            "location" => $vacancy_obj->location
        );

        // header("Content-type: application/json");
        echo json_encode($vacancy_array);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
} else {
    try {
        $vacancy_array = array();
        $vacancy_query = "SELECT * FROM `vacancy`";
        $vacancy_results = $db->fetchQuery($vacancy_query);

        foreach ($vacancy_results as $rec) {
            extract($rec);

            $vStatus = $status==0?'<h6 style="color:#fff;"><span class="badge bg-success">Open</span></h6>':'<h6 style="color:#fff;"><span class="badge bg-secondary">Closed</span></h6>';

            // Fetch Category
            $cQuery = "SELECT * FROM `vacancy_category` WHERE `id` = $category";
            $cObj = $db->fetchObject($cQuery);

            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $vacancy_array[] = array(
                "vacancy_id" => $id,
                "position" => $position,
                "description" => substr($description, 0, 26) . $isEmptyDesc,
                "closing_date" => date('d/m/Y', strtotime($closing_date)),
                "category_id" => $category,
                "category" => $cObj->category,
                "status" => $vStatus,
                "location" => $location,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $vacancy_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
