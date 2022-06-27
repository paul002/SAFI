<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

	if(count($_POST) > 0){
		$id = trim($_POST['id']);
		$label = trim($_POST['txtlabel']);
		$menuLevel = trim($_POST['ddlMenuLevel']);
		$parentMenu = $_POST['ddlParentMenu'];
		$page = trim($_POST['ddlPage']);
		$isActive = isset($_POST['isActive']) ? 1 : 0;
        $message = "";
        $cl = "";
        $fa = "";

		$user = 1;
		if($id == 0){					
			//	SAVE RECORD 
            // Check for duplicates
            $dup = checkForDuplicates($dbo, $label);
            if(count($dup) <= 0){  

                $que = save($dbo, $label, $menuLevel, $parentMenu, $page, $isActive, $user);
                if($que == "OK"){
                    $message = "Menu has been created Successfully.";
                    $cl = "success";
                    $fa = "fa-check";
                }
                else{
                    $message = "Error saving details, kindly try again. ". $que;
                    $cl = "danger";
                    $fa = "fa-exclamation-triangle";
                }
            }else{
                $message = "Menu with name \"".$label."\" already exists";
                $cl = "warning";
                $fa = "fa-exclamation-triangle";
            }
		}else{
			// UPDATE RECORD     						
            $que = update($dbo, $id,  $label, $menuLevel, $parentMenu, $page, $isActive, $user);
            if($que == "OK"){
                $message = "Menu has been Updated Successfully.";
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

	function checkForDuplicates($db, $label){
		try{
			$query = "SELECT `label` FROM `menu` WHERE `label`='$label'";
			$que = $db->fetchQuery($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	function save($db, $label, $menuLevel, $parentMenu, $page, $isActive, $user){
		try{
			$query = "INSERT INTO `menu` SET `label`='$label',`level`='$menuLevel',`isActive`='$isActive',`createdBy`='$user',`modifiedBy`='$user',`dateModified`=CURRENT_TIMESTAMP(),`parent`='$parentMenu',`pageId`='$page'";
			$que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	function update($db, $id,  $label, $menuLevel, $parentMenu, $page, $isActive, $user){
		try{
            $query = "UPDATE `menu` SET `label`='$label',`level`='$menuLevel',`isActive`='$isActive',`createdBy`='$user',`modifiedBy`='$user',`dateModified`=CURRENT_TIMESTAMP(),`parent`='$parentMenu',`pageId`='$page' WHERE `id` = $id";
            $que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
?>
