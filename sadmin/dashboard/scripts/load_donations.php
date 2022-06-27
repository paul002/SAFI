<?php
require_once '../config/dbconn.php';
$db = new db_conn();
if (isset($_GET['id'])) {
    $donations_id = trim($_GET['id']);
    try {
        $donations_array = array();
        $donations_query = "SELECT * FROM `donations` WHERE `id` = $donations_id";
        $donations_obj = $db->fetchObject($donations_query);

        $donations_array[] = array(
            "donor_id" => $donations_obj->id,
            "name" => $donations_obj->name,
            "description" => $donations_obj->description,
            "project" => $donations_obj->project,
            "amount" => $donations_obj->amount,
            "fulfilled" => $donations_obj->fulfilled
        );

        header("Content-type: application/json");
        echo json_encode($donations_array);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
} else {
    try {
        $donations_array = array();
        $donations_query = "SELECT * FROM `donations`";
        $donations_results = $db->fetchQuery($donations_query);

        foreach ($donations_results as $rec) {
            extract($rec);

            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $status = $fulfilled == 1? '<h6 style="color:#fff;"><span class="badge bg-success">Fulfilled</span></h6>':'<h6 style="color:#fff;"><span class="badge bg-secondary">Unfulfilled</span></h6>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $donations_array[] = array(
                "donor_id" => $id,
                "name" => $name,
                "description" => substr($description, 0, 26) . $isEmptyDesc,
                "project" => $project,
                "amount" => $amount,
                "status" => $status,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $donations_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
