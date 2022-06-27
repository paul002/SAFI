<?php
include '../config/dbconn.php';
$db = new db_conn();
$request = 1;

// DataTable data
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

    $searchValue = $db->quote($_POST['search']['value']); // Search value

    ## Search 
    $searchQuery = " ";
    if($searchValue != ''){
        $searchQuery = " and (title like '%".$searchValue."%'";
    }

    ## Total number of records without filtering
    $sel = "select count(*) as allcount from posts";
    $records = $db->fetchQuery($sel);
    $totalRecords = $records['allcount'];

    ## Total number of records with filtering
    $sel = "select count(*) as allcount from posts WHERE 1 ".$searchQuery;
    $records =$db->fetchQuery($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    $empQuery = "select * from posts WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = $db->fetchQuery($empQuery);
    $data = array();

    while ($row = $empRecords) {

        // Update Button
        $updateButton = "<button class='btn btn-sm btn-info updateUser' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row['id']."'>Delete</button>";
        
        $action = $updateButton." ".$deleteButton;

        $data[] = array(
                "title" => $row['title'],
                "postDescription" => $row['postDescription'],
                "path" => $row['imagePath'],
                "isPublished" => $row['isPublished'],
                "createdBy" => $row['createdBy'],
                "dateCreated" => $row['dateCreated'],
                "action" => $action
            );
    }

    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );
    
    header("Content-type: application/json");
    echo json_encode($response);
    exit;