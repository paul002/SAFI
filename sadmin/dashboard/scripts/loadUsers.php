<?php
    require_once "../config/dbconn.php";

    $dbo = new db_conn();

    //  Local
    $message = "";
    $cl = "";
    $icon = "";

    //  Users Array
    $usersArray = array();
    $usersArray['data'] = array();
    try {
        $query = "SELECT * FROM `users` ORDER BY `dateCreated` DESC";
        $result = $dbo->fetchQuery($query);
        foreach($result as $userRec){
            extract($userRec);

            // Check User
            $quser = "SELECT `username` FROM `users` WHERE `createdBy` = $createdBy";
            $userObj = $dbo->fetchObject($quser);

            // Check Status
            $userStatus = $status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">in-Active</span>';

            // Action Buttons
            // fetch permissions
            $permissionQuery = "SELECT * FROM `permissions` WHERE `roleId` = $roleId";
            $permissionObj = $dbo->fetchObject($permissionQuery);
            // edit button
            $btnEdit = $permissionObj->nUpdate == 1 ? '<button class="dropdown-item edit" data-id="'.$id.'" data-firstname="'.$firstName.'" data-lastname="'.$lastName.'" 
            data-middlename = "'.$middleName.'" data-email="'.$email.'" data-username="'.$username.'" data-phone="'.$phoneNo.'" data-image="'.$imagePath.'" data-isactive="'.$status.'" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>' :  '';
            
            // delete button
            $btnDelete = $permissionObj->nDelete == 1 ? '<button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>' : '';
            $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">'.$btnEdit.''.$btnDelete.'</div>';            

            // Rec Array
            $recArray = array();
            $recArray['id'] = $id; 
            $recArray['username'] = $username; 
            $recArray['password'] = $password;
            $recArray['email'] = $email; 
            $recArray['phoneNo'] = $phoneNo; 
            $recArray['firstName'] = $firstName; 
            $recArray['middleName'] = $middleName;
            $recArray['lastName'] = $lastName;
            $recArray['fullName'] = $firstName.' '.$lastName;
            $recArray['status'] = $userStatus;
            $recArray['imagePath'] = $imagePath;
            $recArray['createdBy'] = $userObj->username; 
            $recArray['dateCreated'] = $dateCreated;
            $recArray['modifiedBy'] = $modifiedBy; 
            $recArray['dateModified'] = $dateModified;
            $recArray['actions'] = $buttons;

            array_push($usersArray['data'], $recArray);
        }
        echo json_encode($usersArray);
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
?>