<?php
    require_once '../config/dbconn.php';

    $dbo = new db_conn();

    if(isset($_POST['action']) == 'fetch_companyInfo'){
        $query = "SELECT * FROM `about` ORDER BY `id` ASC";
        $que = $dbo->fetchObject($query);

        echo json_encode($que);
    }
?>