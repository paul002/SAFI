<?php 
    require_once "../config/dbconn.php";

    $dbo = new db_conn();

    $message = "";
    $cl = "";
    $fa = "";
    try {
        // if(isset($_POST['userId'])){
            // Logged In User Roles and Permissions
            $uid =  1; //$_POST['userId'];
            $luq = "SELECT `id`,`roleId` FROM `users` WHERE `id`=$uid;";
            $luob = $dbo->fetchObject($luq);

            $luquery = "SELECT * FROM `roles` WHERE `id` = $luob->roleId";
            $roleObj = $dbo->fetchObject($luquery);

            $lupermiQuery = "SELECT * FROM `permissions` WHERE `roleId` = $roleObj->id";
            $permiObj = $dbo->fetchObject($lupermiQuery);

            // End Logged in User Roles and Permissions


            if($permiObj->nRead == 1){
                $query = "SELECT * FROM `roles` ORDER BY `role` ASC";
                $result = $dbo->fetchQuery($query);
        
                // rolesArray
                $rolesArray = array();
                $rolesArray['data'] = array();
        
                foreach($result as $role){
                    extract($role);
                    // Fetch Permission by ID
                    $permiQuery = "SELECT * FROM `permissions` WHERE `roleId` = $id";
                    $pResult = $dbo->fetchObject($permiQuery);
                    $permId = 0;
                    $create = 0;
                    $read = 0;
                    $update = 0;
                    $delete = 0;
                    $execute = 0;
                    $home = 0;
                    $menu = 0;
                    $posts = 0;
                    $pages = 0;
                    $users = 0;
                    if(!empty($pResult)){
                        $permId = $pResult->id;
                        $create = $pResult->nCreate;
                        $read = $pResult->nRead;
                        $update = $pResult->nUpdate;
                        $delete = $pResult->nDelete;
                        $execute = $pResult->nExecute;
                        $home = $pResult->nHome;
                        $menu = $pResult->nMenu;
                        $posts = $pResult->nPosts;
                        $pages = $pResult->nPages;
                        $users = $pResult->nUsers;
                    }
        
                    // Fetch User
                    $uq = "SELECT `id`,`username` FROM `users` WHERE `id`=$createdBy;";
                    $uob = $dbo->fetchObject($uq);
        
                    // Action Buttons
        
                    // edit Button
                    $btnEdit = $permiObj->nUpdate == 1 ? '<button class="dropdown-item edit" data-id="'.$id.'"  data-role="'.$role.'" data-isactive = "'.$isActive.'"  class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</button>
                                                        <button class="dropdown-item permissions" data-permid="'.$permId.'" data-roleid="'.$id.'" data-role="'.$role.'" data-ncreate="'.$create.'" data-nread="'.$read.'" data-nupdate="'.$update.'" data-ndelete="'.$delete.'" data-nexecute="'.$execute.'" data-home="'.$home.'" data-menu="'.$menu.'" data-posts="'.$posts.'" data-pages="'.$pages.'" data-users="'.$users.'"  class="btn btn-primary"><i class="fas fa-fw fa-user-lock"></i> Permissions</button>' : '';
                    // delete Button
                    $btnDelete = $permiObj->nDelete == 1 ? '<button class="dropdown-item del" data-id="'.$id.'" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>' : '';
                    $buttons = '<button class="d-none d-sm-inline-block btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        '.$btnEdit.'
                        '.$btnDelete.'
                    </div>';
                    
                    // Check Status
                    $roleStatus = $isActive == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">in-Active</span>';
                    $roleArray = array();
                    $roleArray['id'] = $id;
                    $roleArray['role'] = $role;
                    $roleArray['isActive'] = $roleStatus;
                    $roleArray['createdBy'] = $uob->username;
                    $roleArray['dateCreated'] = $dateCreated;
                    $roleArray['modifiedBy'] = $modifiedBy;
                    $roleArray['dateModified'] = $dateModified;
                    $roleArray['actions'] = $buttons;
        
                    array_push($rolesArray['data'], $roleArray);
                }
                header("Content-Type: application/json");
                echo json_encode($rolesArray);   
            }         
        // }
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
?>