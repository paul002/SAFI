<?php 
    require_once '../config/dbconn.php';

    $dbo = new db_conn();

    $mlevelQuery = "SELECT * FROM `menu_level`";
    $mlevelArray = $dbo->fetchQuery($mlevelQuery);

    // Fetch Array
    $responseArray = array();
    $responseArray['data'] = array();

    foreach($mlevelArray as $row){
        extract($row);
        
        $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item edit" data-id="'.$id.'" data-level="'.$level.'" data-description="'.$description.'" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
            <button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
        </div>';

        $menuLevel= array(
            "id" => $id,
            "level" => $level,
            "description" => $description,
            "buttons" =>$buttons
        );

        array_push($responseArray['data'], $menuLevel);
    }
    header("content-type:application/json");
    echo json_encode($responseArray);
?>