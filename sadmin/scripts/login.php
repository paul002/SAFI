<?php
    session_start();
    require_once "../../config/dbconn.php";

    $dbo = new db_conn(); 
    
    $response = array();

    try{
        $status = 0;
        $isActive = 0;
        $cl = "";
        $fa = "";
        if(!empty($_POST)){
            $email = trim($_POST['email']);
            $password = md5($_POST['pass']);

            $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
            $result = $dbo->fetchObject($query);
            if(!empty($result)){
            //     $permissionsQuery = "SELECT * FROM `permissions` WHERE `roleId` = $result->roleId";
            //     $permissionObj = $dbo->fetchObject($permissionsQuery);
                $_SESSION['userId'] = $result->id;
                $_SESSION['username'] = $result->username;
            //     $isActive = $result->status;
            //     $_SESSION['nCreate'] = $permissionObj->nCreate;
            //     $_SESSION['nRead'] = $permissionObj->nRead;
            //     $_SESSION['nUpdate'] = $permissionObj->nUpdate;
            //     $_SESSION['nDelete'] = $permissionObj->nDelete;
            //     $_SESSION['nExecute'] = $permissionObj->nExecute;
            //     $_SESSION['nMenu'] = $permissionObj->nMenu;
            //     $_SESSION['nHome'] = $permissionObj->nHome;
            //     $_SESSION['nPosts'] = $permissionObj->nPosts;
            //     $_SESSION['nPages'] = $permissionObj->nPages;
            //     $_SESSION['nUsers'] = $permissionObj->nUsers;

            //     //  Response
                $status = 1;
                $isActive = 1;
            }else{
                $status = 0;
            }

        }else{
            $status = -1;
        }
        $response = array(
            "status" => $status,
            "isActive" => $isActive
        );
        echo json_encode($response);        
    }catch(Exception $e){
        $response = array(
            "error" => $e
        );
        echo json_encode($response); 
    }
?>