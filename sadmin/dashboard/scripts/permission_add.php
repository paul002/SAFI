<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

	if(count($_POST) > 0){
		$permId = trim($_POST['permId']);
        $roleId = trim($_POST['roleId']);
        $roleName = trim($_POST['roleName']);
		$create = trim($_POST['_create']);
		$read = $_POST['_read'];
        $update = $_POST['_update'];
        $delete = $_POST['_delete'];
        $execute = $_POST['_execute'];
        $menu = $_POST['_menu'];
        $home = $_POST['_home'];
        $posts = $_POST['_posts'];
        $pages = $_POST['_pages'];
        $users = $_POST['_users'];
        // $message = "permId: ".$permId. " , roleId: ". $roleId ." , Create: ". $create ." , read: ". $read ." , update: ". $update ." , delete: ". $delete . " , execute: " . $execute . " , menu: " . $menu . " , home: " . $home . " , posts: " . $posts . " , pages: " . $pages . " , users: " . $users;
        // $message = "";
        $cl = "";
        $fa = "";
		$user = 1;
		if($permId == 0){					
			//	SAVE RECORD 
            // Check for duplicates
            $dup = checkForDuplicates($dbo, $roleId);
            if(count($dup) <= 0){  
                $que = save($dbo, $roleId, $create,$read, $update, $delete, $execute, $menu, $home, $posts, $pages, $users, $user);
                if($que == "OK"){
                    $message = "Permissions has been successfully assigned to ".$roleName." role";
                    $cl = "success";
                    $fa = "fa-check";
                }
                else{
                    $message = "Error saving details, kindly try again. ". $que;
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            }else{
                $message = "Permissions already assigned to \"".$roleName."\". Kindly consider updating";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
		}else{
			// UPDATE RECORD   
            $que = update($dbo, $permId,  $create,$read, $update, $delete, $execute, $menu, $home, $posts, $pages, $users, $user);
            if($que == "OK"){
                $message = "Permissions for ".$roleName." has been Updated Successfully.";
                $cl = "success";
                $fa = "fa-check";
            }else{
                $message = "Error updating details, kindly try again";
                $cl = "danger";
                $fa = "fa-exclamation-triangle";
            }							
		}
		$responseArray['response'] = array(
			"message" => $message,
			"cl" => $cl,
			"fa" => $fa
		  );
        
        // header("Content-Type: application/json");
		echo json_encode($responseArray);
		
	}else{
		// Empty Post
		$message = "There is nothing to post";
		$cl = "warning";
		$fa = "fa-exclamation-triangle";

		$responseArray['response'] = array(
			"message" => $message,
			"cl" => $cl,
			"fa" => $fa
		  );

		echo json_encode($responseArray); 	
	}

	function checkForDuplicates($db, $name){
		try{
			$query = "SELECT `roleId` FROM `permissions` WHERE `roleId`='$name'";
			$que = $db->fetchQuery($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
	function save($db, $roleId, $create,$read, $update, $delete, $execute, $menu, $home, $posts, $pages, $users, $user){
		try{
			$query = "INSERT INTO `permissions` SET `roleId`='$roleId',`nCreate`='$create',`nRead`='$read',`nUpdate`='$update',`nDelete`='$delete',`nExecute`='$execute',`nMenu`='$menu',`nHome`='$home',`nPosts`='$posts',`nPages`='$pages',`nUsers`='$users', `createdBy` = $user, `modifiedBy` = $user, `dateModified` = CURRENT_TIMESTAMP()";
			$que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	function update($db, $id,  $create,$read, $update, $delete, $execute, $menu, $home, $posts, $pages, $users, $user){
		try{
            $query = "UPDATE `permissions` SET `nCreate`='$create',`nRead`='$read',`nUpdate`='$update',`nDelete`='$delete',`nExecute`='$execute',`nMenu`='$menu',`nHome`='$home',`nPosts`='$posts',`nPages`='$pages',`nUsers`='$users', `modifiedBy` = $user, `dateModified` = CURRENT_TIMESTAMP() WHERE `id` = $id";
            $que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
?>
