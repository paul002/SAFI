<?php
include '../config/dbconn.php';
$db = new db_conn();
$request = 1;

if (isset($_GET['key'])) {
    $key = trim($_GET['key']);
    $query = "SELECT * FROM `widgets` WHERE `widget_name` = '$key'";
    $wObj = $db->fetchObject($query);
    $wArray = array(
        'id' => $wObj->id,
        'widgetName' => $wObj->widget_name,
        'content' => $wObj->content
    );
        header("Content-type: application/json");
    echo json_encode($wArray);
    exit;
} 
//else {
//     $query = "SELECT * FROM `widgets`";
//     $row = $db->fetchQuery($query);
//     $widgetsArray = array();
//     $widgetsArray['data'] = array();
//     foreach ($row as $widget) {
//         extract($widget);

//         $w_id = $id;
//         $w_name = $widget_name;
//         $w_content = trim($content);

//         $dataArray = array();
//         $dataArray['widgetId'] = $w_id;
//         $dataArray['widgetName'] = $w_name;
//         $dataArray['widgetContent'] = $w_content;
//         array_push($widgetsArray['data'], $dataArray);
//     }


//     header("Content-type: application/json");
//     echo json_encode($widgetsArray);
//     exit;
// }
