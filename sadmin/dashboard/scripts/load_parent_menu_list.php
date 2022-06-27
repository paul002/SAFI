<?php
require_once '../config/dbconn.php';

if ($_POST["level"]) {
    $dbo = new db_conn();
    $menuLevel = $_POST["level"];
    $mQuery = "";
    if($menuLevel == 2){
        $mQuery = "SELECT * FROM `menu` WHERE `level` = 1";
    }
    if($menuLevel == 3){
        $mQuery = "SELECT * FROM `menu` WHERE `level` = 2";
    }

    $mArray = $dbo->fetchQuery($mQuery);

    // Fetch Array
    $responseArray = array();
    $responseArray['data'] = array();

    foreach ($mArray as $row) {
        extract($row);
        $sQuery = "SELECT * FROM `menu_level` WHERE `level` = $level";
        $sObj = $dbo->fetchObject($sQuery);

        $levelCell = "";
        if ($level == 1) {
            $levelCell = "<i style='padding-left:0px; font-weight: bold'>" . $label . "</i>";
        }
        if ($level == 2) {
            $levelCell = "<i style='padding-left:10px;'>" . $label . "</i>";
        }
        if ($level == 3) {
            $levelCell = "<i style='padding-left:20px;'>" . $label . "</i>";
        }

        $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="' . $id . '" data-label="' . $label . '" data-label="' . $parent . '" data-isactive="' . $isActive . '" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <button class="dropdown-item del" data-id="' . $id . '" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';

        $menu = array(
            "id" => $id,
            "label" => $levelCell,
            "level" => $sObj->description,
            "parent" => $parent,
            "isActive" => $isActive,
            "buttons" => $buttons
        );

        array_push($responseArray['data'], $menu);
    }
    header("content-type:application/json");
    echo json_encode($responseArray);
}
