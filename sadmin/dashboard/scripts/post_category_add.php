<?php
	require_once '../config/dbconn.php';
	$dbo = new db_conn();

	if(count($_POST) > 0){
		$id = $_POST['id'];
		$categoryName = trim($_POST['catName']);
		$description = trim($_POST['catDescription']);		
		$user = 1;
		if($id == 0){					
			//	SAVE RECORD
				// check if category exists
				$check = checkForDuplicates($dbo, $categoryName);
				if(count($check) == 0){
					$que = save($dbo, $categoryName, $description, $user);
					if($que == "OK"){
						$message = "Category has been created Successfully.";
						$cl = "success";
						$fa = "fa-check";
					}
					else{
						$message = "Error saving details, kindly try again.";
						$cl = "danger";
						$fa = "fa-exclamation-triangle";
					}
				}else{
					$message = "Category with Name \"".$categoryName."\" already exists";
					$cl = "danger";
					$fa = "fa-exclamation-triangle";
				}
		}else{
			// UPDATE RECORD				
            $que = update($dbo, $id, $categoryName, $description, $user);
            if($que){
                $message = "Category has been Updated Successfully.";
                $cl = "success";
                $fa = "fa-check";
            }else{
                $message = "Error saving details, kindly try again";
                $cl = "danger";
                $fa = "fa-exclamation-triangle";
            }						
		}

		$responseArray['response'] = array(
			"message" => $message,
			"cl" => $cl,
			"fa" => $fa
		  );

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

	function checkForDuplicates($db, $title){
		try{
			$query = "SELECT `categoryName` FROM `postcategory` WHERE `categoryName`='$title'";
			$que = $db->fetchQuery($query);
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
	function save($db, $categoryName, $description, $user){
		try{
			$query = "INSERT INTO `postcategory` SET `categoryName`='$categoryName',`description`='$description',`createdBy`='$user',`modifiedBy`='$user',`dateModified`=CURRENT_TIMESTAMP()";
			$que = $db->insert($query);
			return $que;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	function update($db, $id, $categoryName, $description, $user){
		try{
            $query = "UPDATE `postcategory` SET `categoryName`='$categoryName',`description`='$description',`modifiedBy`='$user',`dateModified`=CURRENT_TIMESTAMP() WHERE `id` = $id";
            $que = $db->query($query);
            $que->execute();
			return $que;
		}catch(Exception $e){
			return $e->errorMessage();
		}
	}
?>
