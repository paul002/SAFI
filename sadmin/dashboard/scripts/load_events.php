<?php
require_once '../config/dbconn.php';
$db = new db_conn();
if (isset($_GET['id'])) {
    $events_id = trim($_GET['id']);
    try {
        $events_array = array();
        $events_query = "SELECT * FROM `events` WHERE `id` = $events_id";
        $events_obj = $db->fetchObject($events_query);

        $events_array[] = array(
            "event_id" => $events_obj->id,
            "name" => $events_obj->name,
            "description" => $events_obj->description,
            "start_date" => date('d/m/Y', strtotime($events_obj->start_date)),
            "end_date" => date('d/m/Y', strtotime($events_obj->end_date)),
            "location" => $events_obj->location,
            "featImg" => $events_obj->featured_image
        );

        header("Content-type: application/json");
        echo json_encode($events_array);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
} else {
    try {
        $events_array = array();
        $events_query = "SELECT * FROM `events`";
        $event_results = $db->fetchQuery($events_query);

        foreach ($event_results as $rec) {
            extract($rec);

            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $description != "" ? "..." : "";
            $events_array[] = array(
                "event_id" => $id,
                "name" => $name,
                "description" => substr($description, 0, 26) . $isEmptyDesc,
                "start_date" => date('d/m/Y', strtotime($start_date)),
                "end_date" => date('d/m/Y', strtotime($end_date)),
                "location" => $location,
                "featImg" => $featured_image,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $events_array));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
