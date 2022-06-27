<?php
require_once '../config/dbconn.php';
$postType = "page";
$db = new db_conn();
if (isset($_GET['id'])) {
    $impact_area_id = trim($_GET['id']);
    try {
        $impact_areaArray = array();
        $impact_areaQuery = "SELECT * FROM `impact_areas` WHERE `id` = $impact_area_id";
        $impact_areaObj = $db->fetchObject($impact_areaQuery);

        // Fetch Region
        $regionQuery = "SELECT * FROM `region` WHERE `id` = $impact_areaObj->region";
        $regionObj = $db->fetchObject($regionQuery);
        $region = $regionObj->region;
        // Fetch District
        $districtQuery = "SELECT * FROM `districts` WHERE `id` = $impact_areaObj->district";
        $districtObj = $db->fetchObject($districtQuery);
        $district = $districtObj->district;

        $impact_areaArray[] = array(
            "impact_area_id" => $impact_areaObj->id,
            "name" => $impact_areaObj->name,
            "region_id" => $impact_areaObj->region,
            "region" => $region,
            "district_id" => $impact_areaObj->district,
            "district" => $district,
            "t_a" => $impact_areaObj->traditional_authority,
            "lat" => $impact_areaObj->lat,
            "lng" => $impact_areaObj->lng,
            "featImg" => $impact_areaObj->featured_image,
            "content" => $impact_areaObj->content_description
        );

        header("Content-type: application/json");
        echo json_encode($impact_areaArray);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
} else {
    try {
        $impact_areaArray = array();
        $impact_areaQuery = "SELECT * FROM `impact_areas`";
        $impact_area_results = $db->fetchQuery($impact_areaQuery);

        foreach ($impact_area_results as $rec) {
            extract($rec);

            // Fetch Region
            $regionQuery = "SELECT * FROM `region` WHERE `id` = $region";
            $regionObj = $db->fetchObject($regionQuery);
            $_region = $regionObj->region;
            // Fetch District
            $districtQuery = "SELECT * FROM `districts` WHERE `id` = $district";
            $districtObj = $db->fetchObject($districtQuery);
            $_district = $districtObj->district;

            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <a class="dropdown-item del" href="#" data-id="' . $id . '" class="btn btn-danger" data-toggle="modal" data-target="#postDeleteModal"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';
            $isEmptyDesc = $content_description != "" ? "..." : "";
            $impact_areaArray[] = array(
                "impact_area_id" => $id,
                "name" => $name,
                "region_id" => $region,
                "region" => $_region,
                "district_id" => $district,
                "district" => $_district,
                "t_a" => $traditional_authority,
                "lat" => $lat,
                "lng" => $lng,
                "featImg" => $featured_image,
                "content" => $shortTitle = substr($content_description, 0, 26) . $isEmptyDesc,
                "action" => $buttons
            );
        }
        header("Content-type: application/json");
        echo json_encode(array("data" => $impact_areaArray));
    } catch (Exception $e) {
        $message = $e->getMessage();
        $cl = "danger";
        $fa = "fa-exclamation-triangle";
    }
}
