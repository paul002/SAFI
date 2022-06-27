<?php
require_once '../config/dbconn.php';

$dbo = new db_conn();

if (isset($_GET['regId'])) {
    $id = $_GET['regId'];
    $districtArray = array();
    $districtArray['data'] = array();
    $query = "SELECT * FROM `districts` WHERE `region` = $id ORDER BY `id` ASC";
    $que = $dbo->fetchQuery($query);
    foreach ($que as $row) {
        extract($row);
        $temp = array();
        $temp['id'] = $id;
        $temp['district'] = $district;
        array_push($districtArray['data'], $temp);
    }
    header('Content-type: application/json');
    echo json_encode($districtArray);
}
