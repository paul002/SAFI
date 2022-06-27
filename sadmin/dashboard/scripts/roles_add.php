<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

	if(count($_POST) > 0){
		$id = trim($_POST['id']);
		$name = trim($_POST['roleName']);
		$isActive = isset($_POST['isActive']) ? 1 : 0;
        $message = "";
        $cl = "";
        $fa = "";

		$user = 1;
		if($id == 0){					
			//	SAVE RECORD 
            // Check for duplicates
            $dup = checkForDuplicates($dbo, $name);
            if(count($dup) <= 0){  
                $que = save($dbo, $name, $isActive, $user);
                if($que == "OK"){
                    $message = "Role has been created Successfully.";
                    $cl = "success";
                    $fa = "fa-check";
                }
                else{
                    $message = "Error saving details, kindly try again. ". $que;
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            }else{
                $message = "Role with name \"".$name."\" already exists";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
		}else{
			// UPDATE RECORD     						
            $que = update($dbo, $id,  $name, $isActive, $user);
            if($que == "OK"){
                $message = "Role has been Updated Successfully.";
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
			$query = "SELECT `role` FROM `roles` WHERE `role`='$name'";
			$que = $db->fetchQuery($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
	function save($db, $name, $isActive, $user){
		try{
			$query = "INSERT INTO `roles` SET `role` = '$name', `isActive`='$isActive', `createdBy` = $user, `modifiedBy` = $user, `dateModified` = CURRENT_TIMESTAMP()";
			$que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	function update($db, $id,  $name, $isActive, $user){
		try{
            $query = "UPDATE `roles` SET `role` = '$name', `isActive`='$isActive', `modifiedBy` = '$user', `dateModified` = CURRENT_TIMESTAMP() WHERE `id` = $id";
            $que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
?>
