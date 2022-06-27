<?php
require_once '../config/dbconn.php';

$dbo = new db_conn();

if (isset($_GET['action']) == 'reg') {
    $regionsArray = array();
    $regionsArray['data'] = array();
    $query = "SELECT * FROM `region` ORDER BY `id` ASC";
    $que = $dbo->fetchQuery($query);
    foreach ($que as $row) {
        extract($row);
        $temp = array();
        $temp['id'] = $id;
        $temp['region'] = $region;
        array_push($regionsArray['data'], $temp);
    }
    header('Content-type: application/json');
    echo json_encode($regionsArray);
}
